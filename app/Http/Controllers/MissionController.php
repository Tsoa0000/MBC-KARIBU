<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Models\Mission;
use App\Models\Voiture;
use App\Models\DetailChauff;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class MissionController extends Controller {

    public function showMission(Request $request)
{
    $lieu_depart = $request->input('lieu_depart');
    $lieu_arrivee = $request->input('lieu_arrive');
    $date_depart = $request->input('date_depart');
    $date_arrive = $request->input('date_arrive');

    $trajets = Trajet::with(['lieuDepart', 'lieuArrivee'])->get();

    // Si les dates sont fournies, on vérifie la disponibilité
    if ($date_depart && $date_arrive) {
        $voitures = Voiture::all()->map(function ($v) use ($date_depart, $date_arrive) {
            $v->disponible = !Mission::where('voiture_id', $v->id)
                ->where(function ($query) use ($date_depart, $date_arrive) {
                    $query->whereBetween('date_depart', [$date_depart, $date_arrive])
                          ->orWhereBetween('date_arrive', [$date_depart, $date_arrive])
                          ->orWhere(function ($query) use ($date_depart, $date_arrive) {
                              $query->where('date_depart', '<=', $date_depart)
                                    ->where('date_arrive', '>=', $date_arrive);
                          });
                })
                ->exists();
            return $v;
        });

        $chauffeurs = User::where('role', '1')->get()->map(function ($ch) use ($date_depart, $date_arrive) {
            $ch->disponible = !Mission::where('chauffeur_id', $ch->id)
                ->where(function ($query) use ($date_depart, $date_arrive) {
                    $query->whereBetween('date_depart', [$date_depart, $date_arrive])
                          ->orWhereBetween('date_arrive', [$date_depart, $date_arrive])
                          ->orWhere(function ($query) use ($date_depart, $date_arrive) {
                              $query->where('date_depart', '<=', $date_depart)
                                    ->where('date_arrive', '>=', $date_arrive);
                          });
                })
                ->exists();
            return $ch;
        });
    } else {
        // Si pas encore de dates, on marque tout comme disponible par défaut
        $voitures = Voiture::all()->map(function ($v) {
            $v->disponible = true;
            return $v;
        });

        $chauffeurs = User::where('role', '1')->get()->map(function ($ch) {
            $ch->disponible = true;
            return $ch;
        });
    }

    $user = Auth::user();
    if ($user->role === '0') {
        $missions = Mission::with(['lieuDepart', 'lieuArrive', 'voiture', 'chauffeur'])->get();
    } else {
        $missions = Mission::with(['lieuDepart', 'lieuArrive', 'voiture', 'chauffeur'])
            ->where('chauffeur_id', $user->id)
            ->get();
    }

    return view('mission.listeMission', compact('missions', 'trajets', 'voitures', 'chauffeurs', 'user', 'date_depart', 'date_arrive'));
}

public function mission(Request $request) {
    $request->validate([
        'voiture_id' => 'required|exists:voitures,id',
        'chauffeur_id' => 'required|exists:users,id',
        'trajet_id' => 'required',
        'date_depart' => 'required|date',
        'date_arrive' => 'required|date|after_or_equal:date_depart',
        'objet' => 'required|string|max:255',
    ]);

   
    [$lieu_depart, $lieu_arrivee] = explode(' - ', $request->trajet_id);

    $voitureOccupée = Mission::where('voiture_id', $request->voiture_id)
        ->where(function ($query) use ($request) {
            $query->whereBetween('date_depart', [$request->date_depart, $request->date_arrive])
                  ->orWhereBetween('date_arrive', [$request->date_depart, $request->date_arrive])
                  ->orWhere(function ($query) use ($request) {
                      $query->where('date_depart', '<=', $request->date_depart)
                            ->where('date_arrive', '>=', $request->date_arrive);
                  });
        })
        ->exists();

    if ($voitureOccupée) {
        return back()->withErrors([
            'voiture_id' => ' La voiture sélectionnée est déjà affectée à une autre mission pour cette période.',
        ])->withInput();
    }

    $chauffeurOccupé = Mission::where('chauffeur_id', $request->chauffeur_id)
        ->where(function ($query) use ($request) {
            $query->whereBetween('date_depart', [$request->date_depart, $request->date_arrive])
                  ->orWhereBetween('date_arrive', [$request->date_depart, $request->date_arrive])
                  ->orWhere(function ($query) use ($request) {
                      $query->where('date_depart', '<=', $request->date_depart)
                            ->where('date_arrive', '>=', $request->date_arrive);
                  });
        })
        ->exists();

    if ($chauffeurOccupé) {
        return back()->withErrors([
            'chauffeur_id' => ' Le chauffeur sélectionné est déjà en mission pour cette période.',
        ])->withInput();
    }

    // Si tout est libre, création de la mission
    $mission = new Mission();
    $mission->voiture_id = $request->voiture_id;
    $mission->chauffeur_id = $request->chauffeur_id;
    $mission->lieu_depart_id = $lieu_depart;
    $mission->lieu_arrive_id = $lieu_arrivee;
    $mission->date_depart = $request->date_depart;
    $mission->date_arrive = $request->date_arrive;
    $mission->objet = $request->objet;
    $mission->save();

    return redirect()->route('mission.show')->with('success', ' Mission créée avec succès.');
}
public function checkDisponibilite(Request $request)
{
    $date_depart = $request->date_depart;
    $date_arrive = $request->date_arrive;

    // Voitures disponibles
    $voitures = Voiture::all()->map(function ($v) use ($date_depart, $date_arrive) {
        $v->disponible = !Mission::where('voiture_id', $v->id)
            ->where(function ($query) use ($date_depart, $date_arrive) {
                $query->whereBetween('date_depart', [$date_depart, $date_arrive])
                      ->orWhereBetween('date_arrive', [$date_depart, $date_arrive])
                      ->orWhere(function ($query) use ($date_depart, $date_arrive) {
                          $query->where('date_depart', '<=', $date_depart)
                                ->where('date_arrive', '>=', $date_arrive);
                      });
            })->exists();
        return $v;
    });

    // Chauffeurs disponibles
    $chauffeurs = User::where('role', '1')->get()->map(function ($c) use ($date_depart, $date_arrive) {
        $c->disponible = !Mission::where('chauffeur_id', $c->id)
            ->where(function ($query) use ($date_depart, $date_arrive) {
                $query->whereBetween('date_depart', [$date_depart, $date_arrive])
                      ->orWhereBetween('date_arrive', [$date_depart, $date_arrive])
                      ->orWhere(function ($query) use ($date_depart, $date_arrive) {
                          $query->where('date_depart', '<=', $date_depart)
                                ->where('date_arrive', '>=', $date_arrive);
                      });
            })->exists();
        return $c;
    });

    return response()->json([
        'voitures' => $voitures,
        'chauffeurs' => $chauffeurs
    ]);
}
public function delete( $id ) {
    $mission = Mission::findOrFail( $id );
    $mission->delete();
    return redirect()->route( 'mission.show' )->with( 'success', 'Mission supprimée avec succès.' );
}
}

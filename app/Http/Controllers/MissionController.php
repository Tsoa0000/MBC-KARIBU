<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Models\Mission;
use App\Models\Voiture;
use App\Models\DetailChauff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MissionController extends Controller
{
    public function showMission()
    { $trajets= Trajet::all();
        $voitures = Voiture::orderBy('modele')->get();
        $chauffeurs = DetailChauff::with('user_id')->get();
        $missions = Mission::with(['lieuDepart', 'lieuArrivee', 'voiture'])->get();
        return view('mission.listeMission', compact('missions','trajets','voitures', 'chauffeurs'));
    }
    public function mission(Request $request){
        $request -> validate([
            'voiture_id' => 'required|exists:voitures,id',
            'chauffeur_id' => 'required|exists:detail_chauffs,id',
            'lieu_depart' => 'required|exists:trajets,lieu_depart_id',
            'lieu_arrivee' => 'required|exists:trajets,lieu_arrive_id',
            'date_depart' => 'required|date',
            'date_arrive' => 'required|date|after_or_equal:date_depart',
            'objet' => 'required|string|max:255',
        ]);
        $trajets = Trajet::where('lieu_depart_id', $request->lieu_depart)
                    ->where('lieu_arrive_id', $request->lieu_arrivee)
                    ->first();
        if (!$trajets) {
            return redirect()->back()->withErrors(['trajets' => 'Trajet non trouvé.']);
        }
        // Créer une nouvelle mission
        $mission = new Mission();
        $mission->voiture_id = $request->voiture_id;
        $mission->chauffeur_id = $request->chauffeur_id;
        $mission->trajet_id = $request->trajet_id;
        $mission->date_depart = $request->date_depart;
        $mission->date_arrive = $request->date_arrive;
        $mission->objet = $request->objet;
        $mission->save();
        return redirect()->route('mission.show')->with('success', 'Mission créée avec succès.');
    }
}

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
    public function showMission(Request $request)
    {
    $lieu_depart = $request->input('lieu_depart');
    $lieu_arrivee = $request->input('lieu_arrive');

    $trajet = Trajet::where('lieu_depart_id', $lieu_depart)
                    ->where('lieu_arrive_id', $lieu_arrivee)
                    ->first();

    $trajets = Trajet::with(['lieuDepart', 'lieuArrivee'])->get();
    $voitures = Voiture::all();

    $chauffeurs = DetailChauff::all();
    $trajets = Trajet::all();
        $missions = Mission::with(['lieuDepart', 'lieuArrive', 'voiture'])->get();
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
        // Créer une nouvelle mission
        $mission = new Mission();
        $mission->voiture_id = $request->voiture_id;
        $mission->chauffeur_id = $request->chauffeur_id;
        $mission->lieu_depart_id = $request->lieu_depart;
        $mission->lieu_arrive_id = $request->lieu_arrivee;
        $mission->date_depart = $request->date_depart;
        $mission->date_arrive = $request->date_arrive;
        $mission->objet = $request->objet;
        $mission->save();
        return redirect()->route('mission.show')->with('success', 'Mission créée avec succès.');
    }
public function delete($id)
    {
        $mission = Mission::findOrFail($id);
        $mission->delete();
        return redirect()->route('mission.show')->with('success', 'Mission supprimée avec succès.');
}
}


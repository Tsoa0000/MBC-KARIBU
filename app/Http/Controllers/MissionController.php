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
    public function showMission(){
        return view('mission.listeMission');
    }
      public function missions()
    {
       $trajets = Trajet::orderBy('lieu_depart_id')
                         ->orderBy('lieu_arrive_id')
                         ->get();
        $voitures = Voiture::orderBy('modele')->get();
        $chauffeurs = DetailChauff::orderBy('prenom')->get();
        return view('mission.mission.', compact('trajet'));
    }
    public function mission(Request $request){
        $request -> validate([
            'voiture_id' => 'required|exists:voitures,id',
            'chauffeur_id' => 'required|exists:detail_chauffs,id',
            'trajet_id' => 'required|exists:trajets,id',
            'date_depart' => 'required|date',
            'date_arrive' => 'required|date|after_or_equal:date_depart',
            'objet' => 'required|string|max:255',
        ]);
        $mission = new Mission();
        $mission->voiture_id = $request->voiture_id;
        $mission->chauffeur_id = $request->chauffeur_id;
        $mission->trajet_id = $request->trajet_id;
        $mission->date_depart = $request->date_depart;
        $mission->date_arrive = $request->date_arrive;
        $mission->objet = $request->objet;
        $mission->save();
    }
}

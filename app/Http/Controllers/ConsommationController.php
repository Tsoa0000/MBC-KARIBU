<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\Trajet;
use App\Models\Voiture;
use App\Models\Consommation;

class ConsommationController extends Controller
{

public function create()
{
    $voitures = Voiture::all();
    $carburant = ['Diesel', 'Essence'];

    $missions = Mission::with(['voiture', 'lieuDepart', 'lieuArrive'])->get();

    foreach ($missions as $mission) {
        $mission->trajet = Trajet::where('lieu_depart_id', $mission->lieu_depart_id)
                                 ->where('lieu_arrive_id', $mission->lieu_arrive_id)
                                 ->first();
    }

    return view('Carburant.carburant', compact('voitures', 'missions', 'carburant'));
}


    public function store(Request $request)
    {
        $request->validate([
            'mission_id' => 'required|exists:missions,id',
            'typeCarburant' => 'required',
            'prixUnitaire' => 'required|numeric',
        ]);

        $mission = Mission::with(['voiture', 'trajet'])->findOrFail($request->mission_id);

        $voiture = $mission->voiture;
        $trajet = $mission->trajet;

        if (!$trajet) {
            return back()->withErrors(['trajet' => 'Le trajet lié à la mission est introuvable.']);
        }

        $quantite = ($voiture->conso / 100) * $trajet->km;
        $cout_total = $quantite * $request->prixUnitaire;

        $consommation = new Consommation();
        $consommation->voiture_id = $voiture->id;
        $consommation->mission_id = $mission->id;
        $consommation->trajet_id = $trajet->id;
        $consommation->typeCarburant = $request->typeCarburant;
        $consommation->prixUnitaire = $request->prixUnitaire;
        $consommation->quantite = $quantite;
        $consommation->cout_total = $cout_total;
        $consommation->save();

        return back()->with('success', 'Consommation enregistrée avec succès');
    }
}

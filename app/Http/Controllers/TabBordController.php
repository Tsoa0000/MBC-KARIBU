<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TabBord;
use App\Models\ChauffeurDetail;
use App\Models\DetailChauff;

class TabBordController extends Controller
{
    public function create()
    {
        // Alaina daholo ny chauffeurs avy amin'ny table 'chauffeur_details'
        $chauffeurs = DetailChauff::all();

        // Alefa miaraka amin'ny view
        return view('chauffeur.create', compact('chauffeurs'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'date' => 'required|date',
        'idChauff' => 'required|exists:detail_chauffs,id',
        'point_depart' => 'required|string|max:100',
        'destination' => 'required|string|max:100',
        'motif' => 'nullable|string|max:100',
        'dep_km' => 'required|numeric',
        'arr_km' => 'required|numeric|gte:dep_km',
        'heure_depart' => 'required|date_format:H:i',
        'heure_arrivee' => 'required|date_format:H:i|after_or_equal:heure_depart',
        'km_effec' => 'required|numeric',
        'signature' => 'required|boolean',
    ]);

    // Créer une instance et sauvegarder
    $tabbord = new TabBord();
    $tabbord->date = $validated['date'];
    $tabbord->idChauff = $validated['idChauff'];
    $tabbord->point_depart = $validated['point_depart'];
    $tabbord->destination = $validated['destination'];
    $tabbord->motif = $validated['motif'];
    $tabbord->dep_km = $validated['dep_km'];
    $tabbord->arr_km = $validated['arr_km'];
    $tabbord->heure_depart = $validated['heure_depart'];
    $tabbord->heure_arrivee = $validated['heure_arrivee'];
    $tabbord->km_effec = $validated['km_effec'];
    $tabbord->signature = $validated['signature'];
    $tabbord->save();

    return redirect()->back()->with('success', 'Trajet enregistré avec succès !');
}

}

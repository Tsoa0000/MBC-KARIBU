<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Models\Lieu;
use Illuminate\Http\Request;

class TrajetController extends Controller
{
    public function create()
    {
        $lieux = Lieu::all();
        $trajets = Trajet::with(['lieuDepart', 'lieuArrivee'])->get();

        return view('trajet.trajet', compact('lieux', 'trajets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lieu_depart' => 'required|string|max:255',
            'lieu_arrivee' => 'required|string|max:255|different:lieu_depart',
            'typeRoute' => 'required|string|max:255',
            'km' => 'required|numeric|min:0|max:1000',
        ]);

        $lieuDep = Lieu::firstOrCreate(['nomLieu' => $request->lieu_depart]);
        $lieuArr = Lieu::firstOrCreate(['nomLieu' => $request->lieu_arrivee]);

        Trajet::create([
            'lieu_depart_id' => $lieuDep->id,
            'lieu_arrive_id' => $lieuArr->id,
            'typeRoute' => $request->typeRoute,
            'km' => floatval($request->km),
        ]);

        return redirect()->back()->with('success', 'Trajet ajouté avec succès.');
    }

    public function destroy($id)
    {
        $trajet = Trajet::findOrFail($id);
        $trajet->delete();

        return redirect()->back()->with('success', 'Trajet supprimé avec succès.');
    }
}

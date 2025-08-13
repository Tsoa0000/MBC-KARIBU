<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Models\Lieu;
use Illuminate\Http\Request;

class TrajetController extends Controller {
    public function create() {
        $lieux = Lieu::all();
        $trajets = Trajet::with( [ 'lieuDepart', 'lieuArrivee' ] )->get();

        return view( 'trajet.trajet', compact( 'lieux', 'trajets' ) );
    }

    public function store( Request $request ) {
        $request->validate( [
            'lieu_depart' => 'required|string|max:255',
            'lieu_arrivee' => 'required|string|max:255|different:lieu_depart',
            'typeRoute' => 'required|string|max:255',
            'km' => 'required|numeric|min:0|max:1000',
        ] );

        $lieuDep = Lieu::firstOrCreate( [ 'nomLieu' => $request->lieu_depart ] );
        $lieuArr = Lieu::firstOrCreate( [ 'nomLieu' => $request->lieu_arrivee ] );

        Trajet::create( [
            'lieu_depart_id' => $lieuDep->id,
            'lieu_arrive_id' => $lieuArr->id,
            'typeRoute' => $request->typeRoute,
            'km' => floatval( $request->km ),
        ] );

        toastify()->success( 'Trajet ajouté avec succès.');
        return redirect()->back()->with( 'success', 'Trajet ajouté avec succès.' );
    }

    public function edit( $id ) {
        $trajet = Trajet::findOrFail( $id );
        $lieux = Lieu::all();

        return view( 'trajet.edit', compact( 'trajet', 'lieux' ) );
    }
    public function update( Request $request, $id ) {
        $request->validate( [
            'lieu_depart' => 'required|string|max:255',
            'lieu_arrivee' => 'required|string|max:255|different:lieu_depart',
            'typeRoute' => 'required|string|max:255',
            'km' => 'required|numeric|min:0|max:1000',
        ] );

        $trajet = Trajet::findOrFail( $id );
        $lieuDep = Lieu::firstOrCreate( [ 'nomLieu' => $request->lieu_depart ] );
        $lieuArr = Lieu::firstOrCreate( [ 'nomLieu' => $request->lieu_arrivee ] );

        $trajet->update( [
            'lieu_depart_id' => $lieuDep->id,
            'lieu_arrive_id' => $lieuArr->id,
            'typeRoute' => $request->typeRoute,
            'km' => floatval( $request->km ),
        ] );

        toastify()->success('Trajet mis à jour avec succès.');
        return redirect()->route('trajet.create')->with('success', 'Trajet mis à jour avec succès.');
    }
    public function destroy( $id ) {
        $trajet = Trajet::findOrFail( $id );
        $trajet->delete();
        toastify()->success('Trajet supprimé avec succès.');
        return redirect()->back()->with( 'success', 'Trajet supprimé avec succès.' );
    }
}

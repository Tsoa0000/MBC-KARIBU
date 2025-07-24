<?php

namespace App\Http\Controllers;
use App\Models\Voiture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoitureController extends Controller {
    public function showVoiture() {
        $voiture = Voiture::all();

        return view( 'voiture.voiture', compact( 'voiture' ) );

    }

    public function update( Request $request, $id ) {
        $voiture = Voiture::findOrFail( $id );

        $voiture->update( [
            'matricule' => $request->matricule,
            'modele' => $request->modele,
            'typeVehi' => $request->typeVehi,
            'etat' => $request->etat,
            'conso' => $request->conso,
            'nbrPlace' => $request->nbrPlace,
        ] );

        return redirect()->back()->with( 'success', 'Voiture modifiée avec succès.' );
    }
}


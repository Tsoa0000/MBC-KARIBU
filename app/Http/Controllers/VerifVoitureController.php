<?php

namespace App\Http\Controllers;

use App\Models\Voiture;
use App\Models\Verification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerifVoitureController extends Controller {
    //  Affiche le formulaire de vérification

    public function verification() {
        $voiture = Voiture::orderBy( 'matricule' )->get();
        return view( 'voiture.verificationVoiture', compact( 'voiture' ) );
    }

    //  Enregistre une nouvelle vérification

    public function verif ( Request $request ) {
        $request->validate( [
            'date'        => 'required|date',
            'papier'      => 'required|in:1,0',
            'huile'       => 'required|in:1,0',
            'lockeed'     => 'required|in:1,0',
            'eau'         => 'required|in:1,0',
            'pneu'        => 'required|in:1,0',
            'observation' => 'nullable|string|max:255',
            'voiture_id'  => 'required|exists:voitures,id',
        ] );

        Verification::create( [
            'dateVerif'     => $request->date,
            'papierVehi'    => $request->papier,
            'huileMoteur'   => $request->huile,
            'lockeed'       => $request->lockeed,
            'eau'           => $request->eau,
            'pneu'          => $request->pneu,
            'obs'           => $request->observation ?? 'Aucune',
            'voiture_id'    => $request->voiture_id,
        ] );

        return redirect()->route( 'verification.index' );
    }

    //  Liste de toutes les vérifications

    public function index() {
        $verifications = Verification::with( 'voiture' )->latest()->get();
        return view( 'voiture.listeVerification', compact( 'verifications' ) );
    }

    // Delete

    public function delete( $id ) {
        $verifications = Verification::find( $id );
        if ( $verifications ) {
            $verifications->delete();
        }
        return redirect()->route( 'verification.index' )->with( 'success', 'Voiture supprimée.' );
    }
}

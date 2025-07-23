<?php

namespace App\Http\Controllers;

use App\Models\Voiture;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AjoutVoitureController extends Controller {
    private array $types = [ 'Berline', 'SUV', '4x4', 'Camionnette', 'Pick-up', 'Minibus', 'Camion' ];

    public function create() {
        return view( 'voiture.ajoutVoiture', [
            'types' => $this->types,
        ] );
    }

    public function store( Request $request ) {
        $request->merge( [
            'matricule' => strtoupper( $request->matricule ),
        ] );

        $validated = $request->validate( [
            'matricule' => [
                'required',
                'regex:/^[0-9]{4}[A-Z]{3}$/',
                'unique:voitures,matricule',
            ],
            'modele' => 'required|string|max:255',
            'typeVehi' => [ 'required', Rule::in( $this->types ) ],
            'etat' => 'required|integer|min:1|max:10',
            'conso' => 'required|numeric|min:0',
            'nbrPlace' => [ 'required', 'integer', Rule::in( [ 5, 7, 9, 15, 18, 22, 29, 32 ] ) ],
        ] );

        Voiture::create( $validated );
        toastify()->success( 'Voiture ajoutée avec succès.' );
        return redirect()->route( 'voiture' )->with( 'success', 'Voiture ajoutée avec succès.' );
    }

    public function index() {
        $voitures = Voiture::all();
        return view( 'voiture.index', compact( 'voitures' ) );
    }

    public function delete( $id ) {
        $voiture = Voiture::find( $id );
        if ( $voiture ) {
            $voiture->delete();
        }
        toastify()->success( 'Voiture supprimée.' );
        return redirect()->route( 'voiture' )->with( 'success', 'Voiture supprimée.' );
    }

    public function edit( $id ) {
        $voiture = Voiture::findOrFail( $id );
        return view( 'voiture.editVoiture', [
            'voiture' => $voiture,
            'types' => $this->types,
        ] );
    }

    public function update( Request $request, $id ) {
        $voiture = Voiture::findOrFail( $id );

        $request->merge( [
            'matricule' => strtoupper( trim( $request->matricule ) )
        ] );

        $validated = $request->validate( [
            'matricule' => [
                'required',
                'regex:/^[0-9]{4}[A-Z]{3}$/',
                Rule::unique( 'voitures' )->ignore( $voiture->id ),
            ],
            'modele' => 'required|string|max:255',
            'typeVehi' => [ 'required', Rule::in( $this->types ) ],
            'etat' => 'required|integer|min:1|max:10',
            'conso' => 'required|numeric|min:0',
            'nbrPlace' => [ 'required', 'integer', Rule::in( [ 5, 7, 9, 15, 18, 22, 29, 32 ] ) ],
        ] );

        $voiture->update( $validated );
        toastify()->success( 'Voiture mise à jour avec succès.' );
        return redirect()->route( 'voiture' )->with( 'success', 'Voiture mise à jour avec succès.' );
    }
}

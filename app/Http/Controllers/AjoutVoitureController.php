<?php

namespace App\Http\Controllers;

use App\Models\Voiture;
use App\Models\CarType; 
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AjoutVoitureController extends Controller {

    public function create() {
        $types = CarType::pluck('name')->toArray();
        return view('voiture.ajoutVoiture', compact('types'));
    }

    public function store(Request $request) {
        $request->merge([
            'matricule' => strtoupper($request->matricule),
        ]);

        $type = $request->input('typeVehi') === 'autre'
            ? ucfirst($request->input('typeVehiAutre'))
            : $request->input('typeVehi');

       
        if (!CarType::where('name', $type)->exists()) {
            CarType::create(['name' => $type]);
        }

        $typesFromDb = CarType::pluck('name')->toArray();

        if (Voiture::where('matricule', $request->matricule)->exists()) {
            toastify()->error('Le matricule existe déjà.');
            return redirect()->back()->withInput();
        }

        $validated = $request->validate([
            'matricule' => ['required', 'regex:/^[0-9]{4}[A-Z]{3}$/', 'unique:voitures,matricule'],
            'modele'    => 'required|string|max:255',
            'etat'      => 'required|integer|min:1|max:10',
            'conso'     => 'required|numeric|min:0',
            'nbrPlace'  => ['required', 'integer', Rule::in([5, 7, 9, 15, 18, 22, 29, 32])],
            'typeVehi'  => ['required', Rule::in(array_merge($typesFromDb, ['autre']))],
            'typeVehiAutre' => [
                Rule::requiredIf($request->input('typeVehi') === 'autre'),
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        $validated['typeVehi'] = $type;
        unset($validated['typeVehiAutre']);

        Voiture::create($validated);

        toastify()->success('Voiture ajoutée avec succès.');
        return redirect()->route('voiture')->with('success', 'Voiture ajoutée avec succès.');
    }

    public function index() {
        $voitures = Voiture::all();
        return view('voiture.index', compact('voitures'));
    }

    public function delete($id) {
        $voiture = Voiture::find($id);
        if ($voiture) {
            $voiture->delete();
        }
        toastify()->success('Voiture supprimée.');
        return redirect()->route('voiture')->with('success', 'Voiture supprimée.');
    }

    public function edit($id) {
        $voiture = Voiture::findOrFail($id);
        $types = CarType::pluck('nom')->toArray();
        return view('voiture.editVoiture', compact('voiture', 'types'));
    }

    public function update(Request $request, $id) {
        $voiture = Voiture::findOrFail($id);

        $request->merge([
            'matricule' => strtoupper(trim($request->matricule))
        ]);

        $typesFromDb = CarType::pluck('name')->toArray();

        $validated = $request->validate([
            'matricule' => [
                'required',
                'regex:/^[0-9]{4}[A-Z]{3}$/',
                Rule::unique('voitures')->ignore($voiture->id),
            ],
            'modele' => 'required|string|max:255',
            'typeVehi' => ['required', Rule::in($typesFromDb)],
            'etat' => 'required|integer|min:1|max:10',
            'conso' => 'required|numeric|min:0',
            'nbrPlace' => ['required', 'integer', Rule::in([5, 7, 9, 15, 18, 22, 29, 32])],
        ]);

        $voiture->update($validated);

        toastify()->success('Voiture mise à jour avec succès.');
        return redirect()->route('voiture')->with('success', 'Voiture mise à jour avec succès.');
    }
}

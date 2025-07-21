<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TabBord;
use App\Models\User;
use App\Models\ChauffeurDetail;
use App\Models\DetailChauff;

class TabBordController extends Controller
{
    public function create()
    {

        $chauffeurs = DetailChauff::all();
        $user = User::all()->where('id', auth()->user()->id)->first();

        return view('chauffeur.create', compact('chauffeurs', 'user'));
    }
   public function index()
{
    $tabbords = TabBord::with('user')->get();
    return view('chauffeur.listeTab', compact('tabbords'));
}


public function store(Request $request)
{
    $validated = $request->validate([
        'date' => 'required|date',
        'idChauff' => 'required|exists:users,id',
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
    $tabbord->date = $request->date;
    $tabbord->idChauff = $request->idChauff;
    $tabbord->point_depart = $request->point_depart;
    $tabbord->destination = $request->destination;
    $tabbord->motif = $request->motif;
    $tabbord->dep_km = $request->dep_km;
    $tabbord->arr_km = $request->arr_km;
    $tabbord->heure_depart = $request->heure_depart;
    $tabbord->heure_arrivee = $request->heure_arrivee;
    $tabbord->km_effec = $request->km_effec;
    $tabbord->signature = $request->signature;
    $tabbord->save();



    return redirect()->route('tabbord.index');
}
    public function delete($id)
    {
        $tabbord = TabBord::findOrFail($id);
        $tabbord->delete();
        return redirect()->route('tabbord.index')->with('success', 'TabBord deleted successfully.');
    }
}

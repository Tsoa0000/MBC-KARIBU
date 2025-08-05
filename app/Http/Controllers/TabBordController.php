<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TabBord;
use App\Models\User;
use App\Models\DetailChauff;
use App\Models\Mission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TabBordController extends Controller
{

    public function create($mission_id)
    {
        $chauffeurs = DetailChauff::all();
        $user = User::find(auth()->id());

        $mission = Mission::where('id', $mission_id)
                          ->where('chauffeur_id', auth()->id())
                          ->firstOrFail();
        return view('chauffeur.create', compact('chauffeurs', 'user','mission'));
    }

    public function index($mission_id)
    {

        $mission = Mission::where('id', $mission_id)
                          ->where('chauffeur_id', auth()->id())
                          ->firstOrFail();
           $tabbords = TabBord::where('mission_id', $mission_id)->get();
        return view('chauffeur.listeTab', compact('tabbords','mission'));
    }

    public function store(Request $request)
    {
        $chauffeurId = $request->idChauff;
    
        $hasMission = Mission::where('chauffeur_id', $chauffeurId)->exists();
    
        if (!$hasMission) {
            toastify()->error('Vous devez avoir une mission pour créer une fiche de bord.');
            return back()->withInput()->with('error', 'Aucune mission trouvée pour ce chauffeur.');
        }
    

        $validated = $request->validate([
            'date' => 'required|date',
            'idChauff' => 'required|exists:users,id',
            'point_depart' => 'required|string|max:100',
            'destination' => 'required|string|max:100',
            'motif' => 'nullable|string|max:100',
            'dep_km' => 'required|numeric',
            'arr_km' => 'required|numeric|gte:dep_km',
            'heure_depart' => 'required|date_format:H:i',
            'heure_arrivee' => 'required|date_format:H:i',
            'km_effec' => 'required|numeric',
            'signature' => 'required|boolean',
            'mission_id' => 'required|exists:missions,id',
        ]);
    

        $mission = Mission::findOrFail($request->mission_id);
        if (Carbon::parse($mission->date_arrive)->isPast()) {
            toastify()->error('Vous ne pouvez plus ajouter une fiche : la date de mission est déjà passée.');
            return redirect()->back()->with('error', 'Vous ne pouvez plus ajouter une fiche : la date de mission est déjà passée.');
        }
    
   
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
        $tabbord->mission_id = $request->mission_id;
        $tabbord->save();
    
        return redirect()->route('tabbord.index', ['mission' => $request->mission_id]);
    }
    

    public function destroy($id)
    {
        $tabbord = TabBord::findOrFail($id);
        $tabbord->delete();

        return redirect()->route('tabbord.index')->with('success', 'TabBord supprimé avec succès.');
    }
}

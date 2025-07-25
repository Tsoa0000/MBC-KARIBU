<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DetailChauff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DetailChaufController extends Controller
{ /*public function create()
    {
        return view('Authentification.auth');
    }

    // Création de compte
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->first_name = $request->first_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = '1';
        $user->save();

        return redirect()->route('tabbord.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === '1') {
                return redirect()->route('tabbord.index')->with('success', 'Connexion réussie !');
            }
        }

        return back()->withErrors([
            'email' => 'Email incorrect.',
            'password' => 'Mot de passe incorrect.',
        ]);
    }*/

    public function showProfilChauffeur()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour voir votre profil.');
        }

        $detailChauff = DetailChauff::where('user_id', $user->id)->first();
        $typePermis = ['A', 'A1', 'B', 'C', 'D', 'E'];

        return view('ProfilChauffeur.profilChauff', compact('user', 'detailChauff', 'typePermis'));
    }
    public function storeProfilChauffeur(Request $request)
    {
        $request->validate([
            'numeroPermis' => 'required|string|max:20',
            'dateValidite' => 'required|date',
            'typePermis' => 'required|array',
            'typePermis.*' => 'in:A,A1,B,C,D,E',
            'cin' => 'required|string|max:12',
        ]);

        $user = Auth::user();

        $detailChauff = DetailChauff::firstOrNew(['user_id' => $user->id]);

        $detailChauff->numeroPermis = $request->numeroPermis;
        $detailChauff->dateValidite = $request->dateValidite;
        $detailChauff->typePermis = $request->typePermis;
        $detailChauff->cin = $request->cin;
        $detailChauff->user_id = $user->id;
        $detailChauff->save();

        $typePermis = ['A', 'A1', 'B', 'C', 'D', 'E'];
        toastify()->success('Profil créé avec succès !');
        return view('ProfilChauffeur.profilChauff', compact('user', 'detailChauff', 'typePermis'))->with('success', 'Profil créé avec succès !');
    }


    public function updateProfilChauffeur(Request $request, $id)
    {

        $request->validate([
            'cin' => ['required', 'regex:/^\d{12}$/'],
            'dateValidite' => ['required', 'date', 'after_or_equal:today'],
            'typePermis' => 'required|array',
            'typePermis.*' => 'in:A,A1,B,C,D,E',
        ]);


        $detailChauff = DetailChauff::findOrFail($id);


        $detailChauff->cin = $request->input('cin');
        $detailChauff->typePermis = $request->input('typePermis');
        $detailChauff->dateValidite = $request->input('dateValidite');
        $detailChauff->save();

        toastify()->success('Profil mis à jour avec succès !');
        return redirect()
            ->route('profil.chauffeur.edit', $id)
            ->with('success', 'Profil du chauffeur mis à jour avec succès.');
    }


public function editProfil()
{
    $user = auth()->user();
    $detailChauff = DetailChauff::where('user_id', $user->id)->first();
    $typePermis = ['A', 'A1', 'B', 'C', 'D', 'E'];

    return view('ProfilChauffeur.profilChauff', compact('user', 'detailChauff', 'typePermis'));
}

}

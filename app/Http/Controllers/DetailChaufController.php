<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DetailChauff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DetailChaufController extends Controller
{
    public function create()
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

    // Connexion
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
    }

    // Affichage du profil
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
    // Création du profil chauffeur
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

        return view('ProfilChauffeur.profilChauff', compact('user', 'detailChauff', 'typePermis'))->with('success', 'Profil créé avec succès !');
    }

    // Modification du profil
    public function updateProfilChauffeur(Request $request, $id)
    {
        $request->validate([

            'typePermis' => 'required|array',
            'typePermis.*' => 'in:A,A1,B,C,D,E',
        ]);

        $detailChauff = DetailChauff::findOrFail($id);

        $detailChauff->typePermis = $request->typePermis;
        $detailChauff->save();
         $user = auth()->user();
        $typePermis = ['A', 'A1', 'B', 'C', 'D', 'E'];
        return view('ProfilChauffeur.profilChauff', compact('user', 'detailChauff', 'typePermis'));
    }

public function editProfil()
{
    $user = auth()->user();
    $detailChauff = DetailChauff::where('user_id', $user->id)->first();
    $typePermis = ['A', 'A1', 'B', 'C', 'D', 'E'];

    return view('ProfilChauffeur.profilChauff', compact('user', 'detailChauff', 'typePermis'));
}

}

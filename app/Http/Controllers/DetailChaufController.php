<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\DetailChauff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DetailChaufController extends Controller {

    public function create() {

        $typePermis = [ 'A', 'A1', 'B', 'C', 'D', 'E', ];
        return view( 'Authentification.auth', [ 'typePermis' => $typePermis ] );
    }

    public function register( Request $request ) {
        // Validation des données du formulaire
        $request->validate( [
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4',
            'numeroPermis' => 'required|string|max:255',
            'typePermis.*' => 'in:A,A1,B,C,D,E,',
            'typePermis' => 'required|array',
            'dateValidite' => 'required|date',

        ] );

        // Création de l'utilisateur
    $user = new User();
    $user->name = $request->name;
    $user->first_name = $request->first_name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->role = "1";
    $user->save();

    // Création du détail du chauffeur
    $detailChauff = new DetailChauff();
    $detailChauff->numeroPermis = $request->numeroPermis;
    $detailChauff->dateValidite = $request->dateValidite;
    $detailChauff->typePermis =  implode(', ', $request->typePermis);
    $detailChauff->user_id = $user->id;
    $detailChauff->save();

     return redirect()->route('Dash');
}

     public function login(Request $request)
     {
         // Validation des données
         $credentials = $request->validate([
             'email' => 'required|email',
             'password' => 'required',
         ]);

         // Authentification de l'utilisateur
        if ( Auth::attempt( $credentials ) ) {
            // Si l'utilisateur est authentifié, on le redirige en fonction de son rôle
             $user = Auth::user();

             if ($user->role === '1') {
                 return redirect()->route('Dash');  // Remplace avec la route du tableau de bord SuperAdmin
             }
         }

         // Si l'authentification échoue, retourner un message d'erreur
         return back()->withErrors([
             'email' => 'email incorrecte.',
             'password' => 'Mot de passe incorrecte.',
        ] );
    }
}

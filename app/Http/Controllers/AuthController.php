<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'first_name.required' => 'Le prénom est obligatoire.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email n\'est pas valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 4 caractères.',
            'password.confirmed' => 'Les mots de passe saisis ne sont pas identiques.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => '2',
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Votre compte a été créé avec succès !');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email n\'est pas valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            switch ($user->role) {
                case '2':
                    return redirect()->route('dashboard')->with('success', 'Connexion réussie !');
                case '7':
                    return redirect()->route('mission.show')->with('success', 'Connexion réussie en tant qu\'administrateur !');
                case '0':
                    return redirect()->route('dashboard')->with('success', 'Connexion réussie !');
                default:
                    return redirect()->route('dashboard')->with('success', 'Bienvenue !');
            }
        }

        return redirect()->back()
            ->withErrors(['email' => 'Identifiants invalides.'])
            ->withInput($request->only('email'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Déconnexion réussie.');
    }
}

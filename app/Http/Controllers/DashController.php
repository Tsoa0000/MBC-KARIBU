<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Voiture;
use App\Models\DetailChauff;
use App\Models\Mission;
use App\Models\User;

class DashController extends Controller
{
    public function show()
    {
        $nombreVoitures = Voiture::count();
        $nombresChauffeurs = DetailChauff::count();
        $nombresMission = Mission::count();
        $missions = Mission::with(['voiture', 'chauffeur'])
        ->orderByDesc('created_at')
        ->take(3)
        ->get();
        return view('dashboard.dasboard', compact('nombreVoitures','nombresChauffeurs','nombresMission','missions'));
    }
    // GESTION ROLE
    public function gestionRole()
    {
        $users = User::where('role', '!=', '0')->get();
        return view('gestionRole.users', compact('users'));
    }
    // MODIFICATION ROLE
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:2,5,7,0',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('gestionRole')->with('success', 'Rôle mis à jour.');
    }
}

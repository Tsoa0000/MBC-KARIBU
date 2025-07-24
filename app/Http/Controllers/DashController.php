<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Voiture;
use App\Models\DetailChauff;
use App\Models\Mission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    public function gestionRole()
    {
        $users = User::where('role', '!=', '0')->get();
        return view('gestionRole.users', compact('users'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:2,5,7,0',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();
        toastify()->success('Rôle mis à jour avec succès !');
        return redirect()->route('gestionRole')->with('success', 'Rôle mis à jour.');
    }
    public function showAdminProfile()
    {
        return view('profilAdmin.admin');
    }
    public function editProfile()
    {
        return view('profilAdmin.edit');
    }
    public function updateInfo(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
    ]);

    $user = Auth::user();
    $user->update($request->only(['name', 'first_name', 'email']));

    return redirect()->back()->with('success', 'Informations mises à jour.');
}

}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Voiture;
use App\Models\DetailChauff;
use App\Models\Mission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    public function show()
    { $year = date('Y');
        $nombresMission = Mission::count();


    $labels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
    $data = [];

        $nombreVoitures = Voiture::count();
        $nombresChauffeurs = DetailChauff::count();
        $nombresMission = Mission::count();
        $missions = Mission::with(['voiture', 'chauffeur'])
        ->orderByDesc('created_at')
        ->take(3)
        ->get();
           return view('dashboard.dasboard', compact('nombreVoitures', 'nombresChauffeurs', 'nombresMission', 'missions', 'labels', 'data', 'year'));
    }

    public function gestionRole()
    {
        $users = User::where('role', '!=', '0')->get();
        return view('gestionRole.users', compact('users'));
    }

public function updateRole(Request $request, $id)
{
    $request->validate([
        'role' => 'required|in:2,5,7',
    ]);

    $user = User::findOrFail($id);

    if ($user->detailChauff && $request->role != 7) {
        toastify()->error('Ce chauffeur a déjà rempli son profil. Son rôle ne peut plus être modifié.');
        return back()->with('error', 'Ce chauffeur a déjà rempli son profil. Son rôle ne peut plus être modifié.');
    }

    $user->role = $request->role;
    $user->save();
    toastify()->success('Rôle mis à jour avec succès');
    return back()->with('success', 'Rôle mis à jour avec succès');
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
public function missionsParMois(Request $request)
{
    $year = $request->input('year', date('Y'));

    $missions = Mission::select(
        DB::raw('MONTH(created_at) as month'),
        DB::raw('COUNT(*) as total')
    )
    ->whereYear('created_at', $year)
    ->groupBy('month')
    ->orderBy('month')
    ->get();

    $data = array_fill(1, 12, 0);
    foreach ($missions as $m) {
        $data[$m->month] = $m->total;
    }

    $labels = [];
    for ($i = 1; $i <= 12; $i++) {
        $labels[] = Carbon::create()->month($i)->format('M');
    }

    $nombreVoitures = Voiture::count();
    $nombresChauffeurs = DetailChauff::count();
    $nombresMission = Mission::count();

    return view('dashboard.dasboard', [
        'labels' => $labels,
        'data' => array_values($data),
        'year' => $year,
        'nombreVoitures' => $nombreVoitures,
        'nombresChauffeurs' => $nombresChauffeurs,
        'nombresMission' => $nombresMission,
    ]);
}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
  use Illuminate\Support\Str;

class RapportController extends Controller
{

public function index(Request $request)
{
    $chauffeurId = $request->input('chauffeur_id');

    $rapport = DB::table('tab_bords')
        ->join('users', 'tab_bords.idChauff', '=', 'users.id')
        ->select(
            'tab_bords.*',
            'users.name as user_name',
            'users.first_name as user_first_name',
            'users.email as user_email'
        )
        ->get();

    if ($chauffeurId) {
        $rapport = $rapport->filter(function ($item) use ($chauffeurId) {
            return $item->idChauff == $chauffeurId;
        })->values();
    }


    foreach ($rapport as $r) {
        $r->initiales = strtoupper(Str::substr($r->user_name, 0, 1) . Str::substr($r->user_first_name, 0, 1));
    }

    $chauffeurs = DB::table('users')->get();

    return view('rapport.rapport', compact('rapport', 'chauffeurs'));
}

public function liste($id = null)
{
    $query = DB::table('tab_bords')
        ->join('users', 'tab_bords.idChauff', '=', 'users.id')
        ->join('missions', 'tab_bords.mission_id', '=', 'missions.id')
        ->join('lieux as ld', 'missions.lieu_depart_id', '=', 'ld.id')
        ->join('lieux as la', 'missions.lieu_arrive_id', '=', 'la.id')
        ->select(
            'tab_bords.*',
            'users.name as user_name',
            'users.first_name as user_first_name',
            'users.email as user_email',
            'ld.nomLieu as lieu_depart_nom',
            'la.nomLieu as lieu_arrive_nom'
        );

    if ($id) {
        $query->where('tab_bords.idChauff', $id);
    }

    $rapport = $query->get();

    $missions = $rapport->groupBy(function ($item) {
        return $item->lieu_depart_nom . ' - ' . $item->lieu_arrive_nom;
    });

    return view('rapport.listeM', compact('missions'));
}


}


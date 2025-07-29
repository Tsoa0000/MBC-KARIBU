<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function index()
{
    // 1. Récupération des missions avec les trajets
    $missions = DB::table('missions')
        ->join('trajets', function ($join) {
            $join->on('missions.lieu_depart_id', '=', 'trajets.lieu_depart_id')
                 ->on('missions.lieu_arrive_id', '=', 'trajets.lieu_arrive_id');
        })
        ->select(
            'missions.date_depart',
            'missions.date_arrive',
            'missions.lieu_depart_id',
            'missions.lieu_arrive_id',
            'missions.chauffeur_id',
            'missions.voiture_id',
            'missions.objet',
            'trajets.km'
        )
        ->get();


    $tabBords = DB::table('tab_bords')
        ->select('id', 'heure_depart', 'date')
        ->get();

    $rapports = $missions->map(function ($mission) use ($tabBords) {

        $tabBord = $tabBords->first(function ($tb) use ($mission) {
            return
                   $tb->date == $mission->date_depart;
        });

        return (object)[
            'date_mission'   => $mission->date_depart,
            'lieu_depart'    => $mission->lieu_depart_id,
            'lieu_arrive'    => $mission->lieu_arrive_id,
            'heure_depart'   => $tabBord->heure_depart ?? 'Non renseignée',
            'chauffeur_id'   => $mission->chauffeur_id,
            'voiture_id'     => $mission->voiture_id,
            'kilometrage'    => $mission->km,
            'duree'          => \Carbon\Carbon::parse($mission->date_arrive)
                                    ->diffInDays(\Carbon\Carbon::parse($mission->date_depart)),
            'objet'          => $mission->objet,
        ];
    });
$chauffeurs = DB::table('users')
    ->select('id', DB::raw("CONCAT(first_name, ' ', name) as full_name"))
    ->pluck('full_name', 'id');
$voiture = DB::table('voitures')
    ->select('id',DB::raw("CONCAT(modele, ' ',matricule ) as immatriculation"))
    ->pluck('immatriculation', 'id');

    // 2. Récupération des lieux
$lieux = DB::table('lieux')->pluck('nomLieu', 'id');

    return view('rapport.rapport', compact('rapports','lieux', 'chauffeurs','voiture'));
}




}

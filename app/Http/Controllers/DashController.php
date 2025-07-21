<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Voiture;
use App\Models\DetailChauff;
use App\Models\Mission;



class DashController extends Controller
{
    public function show()
    {
        $nombreVoitures = Voiture::count();
        $nombresChauffeurs = DetailChauff::count();
        $nombresMission = Mission::count();
        return view('dashboard.dasboard', compact('nombreVoitures','nombresChauffeurs','nombresMission'));

    }
}

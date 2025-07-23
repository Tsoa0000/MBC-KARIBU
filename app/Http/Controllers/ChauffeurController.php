<?php

namespace App\Http\Controllers;

use App\Models\DetailChauff;
use App\Models\User;
use Illuminate\Http\Request;

class ChauffeurController extends Controller
{
   public function index()
{
    $chauffeurs = User::where('role', '7')
        ->whereHas('detailChauff')
        ->with('detailChauff')
        ->get();
    return view('chauffeur.index', compact('chauffeurs'));
}

}

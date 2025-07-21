<?php

namespace App\Http\Controllers;

use App\Models\DetailChauff;
use Illuminate\Http\Request;

class ChauffeurController extends Controller
{
    public function index()
    {
        $chauffeurs = DetailChauff::all();
        return view('chauffeur.index', compact('chauffeurs'));
    }
}

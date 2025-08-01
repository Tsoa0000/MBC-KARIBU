<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarType;

class CarTypeController extends Controller
{
    public function create()
    {
        return view('car_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        CarType::create([
            'name' => $request->name
        ]);
        toastify()->success('Type de voiture ajouté avec succès.');
        return redirect()->back()->with('success', 'Type de voiture ajouté avec succès.');
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RapportController extends Controller
{
    /**
     * Display the rapport view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('rapport.rapport');
    }


}

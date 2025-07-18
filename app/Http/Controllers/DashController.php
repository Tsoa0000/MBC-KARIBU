<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;


class DashController extends Controller
{
    public function show()
    {
        return view("dashboard.dasboard");
    }
}

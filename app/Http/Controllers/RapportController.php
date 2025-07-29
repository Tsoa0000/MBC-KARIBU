<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function index()
{
    $rapport = DB::table('tab_bords')
    ->join('users', 'tab_bords.idChauff', '=', 'users.id')
    ->select(
        'tab_bords.*',
        'users.name as user_name',
        'users.first_name as user_first_name'
    )
    ->get();


    return view('rapport.rapport', compact('rapport'));
}
}

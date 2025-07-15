<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lieu_type_voiture extends Model
{
     protected $fillable = [

        'lieu_depart_id',
        'lieu_arrivee_id',
        'voiture_id',
        'type_route',

    ];
    use HasFactory;
}

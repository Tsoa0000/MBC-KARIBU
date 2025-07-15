<?php

namespace App\Models;
use App\Models\Trajet;
use App\Models\Voiture;
use App\Models\DetailChauff;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
     use HasFactory;
     protected $fillable =[
        'voiture_id',
        'chauffeur_id',
        'trajet_id',
        'date_depart',
        'date_arrive',
        'objet',

     ];
}


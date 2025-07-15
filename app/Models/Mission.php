<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
     public function lieuDepart() {
    return $this->belongsTo(Lieu::class, 'lieu_depart_id');
}
public function lieuArrivee() {
    return $this->belongsTo(Lieu::class, 'lieu_arrivee_id');
}
public function voiture() {
    return $this->belongsTo(Voiture::class, 'voiture_id');
}
}


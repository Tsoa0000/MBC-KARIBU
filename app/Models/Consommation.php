<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consommation extends Model
{
    protected $fillable =[
        'voiture_id',
        'trajet_id',
        'typeCarburant',
        'prixUnitaire',
        'quantite'
    ];
    public function voitures()
{
    return $this->hasMany(Voiture::class);
}
 public function trajets()
    {
        return $this->hasMany(Trajet::class);
    }
    use HasFactory;
}

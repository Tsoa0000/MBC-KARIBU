<?php

namespace App\Models;

use App\Models\Verification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voiture extends Model
{
      protected $fillable = [
        'id',
        'matricule',
        'modele',
        'typeVehi',
        'etat',
        'conso',
        'nbrPlace'
    ];
    public function verification() {

        return $this->hasMany(Verification::class);
    }
    use HasFactory;
}

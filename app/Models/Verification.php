<?php

namespace App\Models;

use App\Models\Voiture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Verification extends Model {
    use HasFactory;
    protected $fillable = [

        'id',
        'dateVerif',
        'papierVehi',
        'huileMoteur',
        'lockeed',
        'eau',
        'pneu',
        'obs',
        'voiture_id',
    ];

    public function voiture() {
        return $this->belongsTo( Voiture::class );
    }
}

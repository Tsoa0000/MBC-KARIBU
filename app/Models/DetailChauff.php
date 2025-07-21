<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailChauff extends Model {

    use HasFactory;

    protected $fillable = [
        'numeroPermis',
        'dateValidite',
        'typePermis',
        'cin',
        'user_id',

    ];
    protected $casts = [
        'typePermis' => 'array',
        'dateValidite' => 'date'
    ];

    public function voiture() {
        return $this->hasMany( Voiture::class, 'chauffeur_id' );
    }

    public function user() {
        return $this->belongsTo( User::class, 'user_id' );
    }
}

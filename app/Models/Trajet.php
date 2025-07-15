<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;

    protected $fillable = [
        'lieu_depart_id',
        'lieu_arrive_id',
        'typeRoute',
        'km',
    ];


    public function lieuDepart()
{
    return $this->belongsTo(Lieu::class, 'lieu_depart_id');
}

public function lieuArrivee()
{
    return $this->belongsTo(Lieu::class, 'lieu_arrive_id');
}

}

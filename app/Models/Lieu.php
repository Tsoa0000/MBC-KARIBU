<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    use HasFactory;
    protected $table = 'lieux';
    protected $fillable = [
        'nomLieu',
    ];

    public function trajetsDepart()
{
    return $this->hasMany(Trajet::class, 'lieu_depart_id');
}

public function trajetsArrivee()
{
    return $this->hasMany(Trajet::class, 'lieu_arrive_id');
}

}

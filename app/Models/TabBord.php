<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailChauff;

class TabBord extends Model
{
    protected $table = 'tab_bords';

    protected $fillable = [
        'date',
        'idChauff',
        'point_depart',
        'destination',
        'motif',
        'dep_km',
        'arr_km',
        'heure_depart',
        'heure_arrivee',
        'km_effec',
        'signature',
    ];

    public function chauffeur()
    {
        return $this->belongsTo(DetailChauff::class, 'idChauff');
    }
}

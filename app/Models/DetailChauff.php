<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailChauff extends Model
{

    use HasFactory;

    protected $fillable = [
        'numeroPermis',
        'dateValidite',
        'typePermis',
        'user_id',

    ];
    protected $casts = [
        'typePermis' => 'array',
        'dateValidite' => 'date'
    ];
}

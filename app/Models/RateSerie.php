<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateSerie extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'serie_id',
        'like',
        'comment',
        'rate',
    ];
}

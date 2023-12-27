<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateMovie extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'movie_id',
        'like',
        'comment',
        'rate',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'profile-picture',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movies_has_profiles()
    {
        return $this->belongsToMany(Movie::class, 'profiles_has_movies', 'movie_id', 'profile_id');
    }

    public function series_has_profiles()
    {
        return $this->belongsToMany(Serie::class);
    }

    public function ratemovies()
    {
        return $this->belongsToMany(Movie::class)->using(RateMovie::class)->withPivot(['profile_id',
            'movie_id',
            'like',
            'comment',
            'rate', ]);
    }
}

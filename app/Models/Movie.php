<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'director',
        'sipnosis',
        'cover-art',
        'duration',
        'year',
        'admin_id',
    ];

    public function categories(){
        return $this->belongsToMany(Category::class, 'movie_has_categories', 'movie_id', 'category_id');
    }

    public function ratemovies(){
        return $this->belongsToMany(Profile::class)->using(RateMovie::class)->withPivot([ 'profile_id',
        'movie_id',
        'like',
        'comment',
        'rate',]);
    }

    public function profile_has_movie(){
        return $this->belongsToMany(Profile::class,'profiles_has_movies', 'movie_id', 'profile_id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
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

    public function serie_has_profile(){
        return $this->belongsToMany(Profile::class,'profiles_has_series', 'serie_id', 'profile_id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function seasons(){
        return $this->hasMany(Season::class);
    }
}

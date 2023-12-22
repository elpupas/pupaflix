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

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function seasons(){
        return $this->hasMany(Season::class);
    }
}

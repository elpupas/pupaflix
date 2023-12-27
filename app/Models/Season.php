<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'season',
        'cover-art',
        'serie_id',
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
}

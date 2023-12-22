<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
];


    public function series(){
        return $this->hasMany(Serie::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}

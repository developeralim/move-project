<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seasion extends Model
{ protected $guarded = [];
    public function sesion_movie()
    {
        return $this->belongsToMany(Movie::class, 'movie_seasion_relationships', 'seasion_id', 'movie_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $guarded = [];
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'movie_category_reletionships', 'movie_id', 'category_id');
    }
    public function seasions()
    {
        return $this->belongsToMany(Seasion::class, 'movie_seasion_relationships', 'movie_id', 'seasion_id');
    }

}

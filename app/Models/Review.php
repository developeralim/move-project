<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];

    public function movie(){
        return $this->belongsTo(Movie::class,'review_movie_id','id');
    }
    public function member(){
        return $this->belongsTo(Member::class,'member_id','id');
    }
}

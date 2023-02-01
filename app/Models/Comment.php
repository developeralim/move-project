<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

        protected $guarded = [];
        public function movie(){
            return $this->belongsTo(Movie::class,'comment_movie_id','id');
        }
        public function member(){
            return $this->belongsTo(User::class,'comment_author_email','id');
        }

}

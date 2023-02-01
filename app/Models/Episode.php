<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $guarded = [];

    public function seasion(){
        return $this->belongsTo(Seasion::class,'seasion_id','id');
    }
}

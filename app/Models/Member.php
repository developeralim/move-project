<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    protected $guarded = [];
    protected $hidden = [
        'password',
    ];


}

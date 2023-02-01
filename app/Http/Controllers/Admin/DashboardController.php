<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Episode;
use App\Models\Member;
use App\Models\Movie;
use App\Models\Review;
use App\Models\Seasion;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard (){
        return view('backend.pages.dashboard.index',[
            'user'=>Member::count(),
            'category'=>Category::count(),
            'movie'=>Movie::count(),
            'seasion'=>Seasion::count(),
            'episode'=>Episode::count(),
            'review'=>Review::count(),
            'comment'=>Comment::count(),
        ]);
    }
}

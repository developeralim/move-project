<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    protected int $slider_limit = 10;

    public function home(Request $request) {

        return \view('pages.home',[
            'loading'         => true,
            'loading_txt'     => 'Daag',
            'slider'          => $this->slider( $this->slider_limit ),
            'movie'           => [...$this->get_to_show_movie_on_home()],
        ]);
    }

    
    protected function slider($item = 10) 
    {
        $latest_movies = Movie::where("status",1)->take($item)->orderby('id','DESC')->get();

        $slider_movie = [];
        
        foreach ($latest_movies as $_movie) {
            $slider_movie[] = [
                'id'              => $_movie->id,
                'title'           => $_movie->name,
                'description'     => \substr($_movie->description,0,100) . '...',
                'btn_txt'         => 'Watch Now',
                'cover_photo'     => $_movie->cover_photo,
                'category'        =>  static::get_category_by_movie_id($_movie->id),
                'single_link'     => \route('single',[$_movie->id,$_movie->drive_id]),
            ];
        }

        return $slider_movie;
    }


    public static function get_category_by_movie_id ( $id ) 
    {
        return DB::table('movie_category_reletionships')
            ->join('movies','movies.id','=','movie_category_reletionships.movie_id')
            ->join('categories','movie_category_reletionships.category_id','=','categories.id')
            ->select('categories.name','categories.id','categories.slug')
            ->where('movie_id',$id)->get();
    }

    protected function get_to_show_movie_on_home() 
    {
        $front_page_category = $this->get_to_show_front_page_category();


        $movies = [];

        foreach ($front_page_category as $_category) 
        {
            $category_name = Category::where('id',$_category->id)->first()->name;

            $query = DB::table('movie_category_reletionships')
            ->orderby('movies.id','DESC')
            ->join('movies','movies.id','=','movie_category_reletionships.movie_id')
            ->where('category_id',$_category->id);

            // check if any movies are under this category

            if ( $query->count() !== 0 ) 
            {     
                $movies[$category_name] = [
                    'category_id' => $_category->id,
                    'class'     => ($_category->id % 2) == 0 ? 'home__carousel' : 'home__carousel__odd',
                    'movies' => $query->get(),
                ];
            }
        }

        return $movies;
    }

    protected function get_to_show_front_page_category () 
    {
        return Category::where([
                ['status',1],
                ['show_frontpage',1]
        ])->get();
    }

}
<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ArchivePageController extends Controller
{
    protected int $item = 40;

    public function archive(Request $request,$category_id,$category_slug) {

        $filered_by = \request()->query();

        $category = [
            new class($category_id){

                public int $id ;
                public function __construct($category_id){
                    $this->id = $category_id;
                }

            }
        ];

        $paginate_movie = $this->get_movie_by_category($category,$filered_by)[0] ?? null;

        $next         = $paginate_movie->currentPage() + 1;
        $next_disable = false;

        // check if next going exceed the total page number

        if ( $next > $paginate_movie->lastPage() ) {
              $next           = $paginate_movie->lastPage();
              $next_disable   = true;
        }

        $prev           = $paginate_movie->currentPage() - 1;
        $prev_disable   = false;
        // check if prev page exceed 1
        if ( $prev < 1 ) {
              $prev           = 1;
              $prev_disable   = true;
        }

        // check page record less than limit
        if ( $this->item >=  \count($paginate_movie)) {
            $this->item = \count($paginate_movie);
        }


        return \view('pages.archive',[
            'movies'        => $this->modified_movie_by_category($paginate_movie),
            'category'      => \strtoupper(str_replace('_',' ',$category_slug)),
            'next'          => $next,
            'prev'          => $prev,
            'next_disable'  => $next_disable,
            'prev_disable'  => $prev_disable,
            'current_page'  => $paginate_movie->currentPage(),
            'total'         => $paginate_movie->total(),
            'limit'         => $this->item,
            'last_page'     => $paginate_movie->lastPage(),
            'pagination'    => $paginate_movie->lastPage() > 1,
        ]); 
  }

    protected static function get_category_by_movie_id ( $id ) 
    {
        return DB::table('movie_category_reletionships')
            ->join('movies','movies.id','=','movie_category_reletionships.movie_id')
            ->join('categories','movie_category_reletionships.category_id','=','categories.id')
            ->select('categories.name','categories.id','categories.slug')
            ->where('movie_id',$id)->get();
    }

    protected function get_movie_by_category($categories,$filter = []) 
    {
        $recomended_movie = []; //define an array to keep movies getting by $categories

        $quality = '';
        $year_filter_end = date('Y');
        $year_filter_start = '1';

        if ( ! empty ( $filter )  ) {
            \extract($filter);
        } 
        
        foreach ($categories as $_category) {
            $recomended_movie[] = DB::table('movies')
                ->join('movie_category_reletionships','movies.id','=','movie_category_reletionships.movie_id')
                ->where('movie_category_reletionships.category_id',$_category->id)
                ->where('movies.quality','like',"%$quality%")
                ->whereBetween('movies.relese_year',[$year_filter_start,$year_filter_end])
                ->paginate($this->item);
                
        }

        return $recomended_movie;
    }

    protected function modified_movie_by_category ( $recomended_movie,$exclude = null ) 
    {
        //get unique records by filtering
        $unique_movie = [];

        if ( \is_array($recomended_movie) && ! empty ( $recomended_movie ) ) {

            foreach ($recomended_movie as $collection) {

                    foreach ( $collection as $_movie) {

                        if ( \is_array($exclude) ) {
                            if ( \in_array( $_movie->movie_id,$exclude ) ) continue;
                        } 

                        if ( \is_string($exclude) ) {
                            if ( $_movie->movie_id == $exclude ) continue;
                        }

                        $unique_movie[] = [
                            'id'           => $_movie->movie_id,
                            'name'         => $_movie->name,
                            'cover_photo'  => $_movie->cover_photo,
                            'movie_review' => $_movie->movie_review,
                            'category'     => $this->get_category_by_movie_id($_movie->id),
                            'drive_id'     => $_movie->drive_id
                        ];

                    }                  
            }
        }

        if ( is_object( $recomended_movie ) ) {
            foreach ( $recomended_movie as $_movie) {
                if ( \is_array($exclude) ) {
                    if ( \in_array( $_movie->movie_id,$exclude ) ) continue;
                } 

                if ( \is_string($exclude) ) {
                    if ( $_movie->movie_id == $exclude ) continue;
                }

                $unique_movie[] = [
                    'id'           => $_movie->movie_id,
                    'name'         => $_movie->name,
                    'cover_photo'  => $_movie->cover_photo,
                    'movie_review' => $_movie->movie_review,
                    'category'     => $this->get_category_by_movie_id($_movie->id),
                    'drive_id'     => $_movie->drive_id
                ];
            } 
        }

        return $unique_movie;
    }

}

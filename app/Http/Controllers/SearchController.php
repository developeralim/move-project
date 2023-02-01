<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    protected int $item = 40;

    public function search(  ) {

        $filered_by = \request()->query();

        $movies = $this->get_search_movie($filered_by);

        // movies for pagination
        $paginate_movie = $this->get_search_movie( $filered_by );

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


        return \view('pages.search',[
              'movies'        => $this->modified_search_movie($paginate_movie),
              'search'        => $filered_by['search'] ?? '',
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

    protected function modified_search_movie( $search_movies, $exclude = null) {

        $modify_search = [];

        foreach ($search_movies as $_movie) {

              if ( \is_array($exclude) ) {
                    if ( \in_array( $_movie->id,$exclude ) ) continue;
              } 

              if ( \is_string($exclude) ) {
                    if ( $_movie->id == $exclude ) continue;
              }

              $modify_search[] = [
                    'id'           => $_movie->id,
                    'name'         => $_movie->name,
                    'cover_photo'  => $_movie->cover_photo,
                    'movie_review' => $_movie->movie_review,
                    'category'     => $this->get_category_by_movie_id($_movie->id),
                    'drive_id'     => $_movie->drive_id
              ];                
        }

        return $modify_search;
    }

    protected function get_search_movie( $filter = [] ) 
    {

        if ( empty ( $filter ) ) return;

        $quality = '';
        $year_filter_end = date('Y');
        $year_filter_start = '1';
        $search = '';

        if ( ! empty ( $filter )  ) {
            \extract($filter);
        } 
                
        $search_movies = DB::table('movies');

        if ( $quality == "" ) {
            $search_movies->where('name','like',"%$search%")
            ->orWhere('slug','like',"%$search%")
            ->orWhere('country','like',"%$search%")
            ->orWhere('description','like',"%$search%")
            ->orWhere('movie_meta','like',"%$search%");
        } else {
            $search_movies->where('quality','like',"%$quality%")
            ->whereBetween('relese_year',[$year_filter_start,$year_filter_end]);
        }

        $search_movies = $search_movies->paginate($this->item);
        
        return $search_movies;

    }

}
<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Member;
use App\Models\Review;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SinglePageController extends Controller
{

    protected int $item = 40;

    public function single(Request $request,$id) {

        $single_movie     = Movie::where('id',$id)->get();

        $movie_categories = static::get_category_by_movie_id($id);

        // reviews
        $review = Review::where([
            ['review_movie_id',$id],
            ['status',1]
        ])->get();

        $optimized_review = [];

        foreach ($review as $_review) {
            $optimized_review [] = [
                'review_title'  => $_review->review_title,
                'review_txt'    => $_review->review_text,
                'review_date'   => $_review->created_at->format('d M Y H:i m'),
                'review_author' => $this->get_review_author($_review->review_autor),
                'review_rate'   => $_review->review_rate,
            ];
        }
     
        // get recommended movie
        if ( $movie_categories->count() != 0 ) {
            $recomended_movie = $this->modified_movie_by_category(
                $this->get_movie_by_category($movie_categories),$id
            );
        } else {
            $recomended_movie = false;
        }

        $quality = [];
        $download_links = [];

        if ( isset($single_movie[0]) && $quality_string = $single_movie[0]->quality) {

            $qualities = \explode(',',trim($quality_string,' '));
            
            foreach ( $qualities as $value) {
                list($res,$id) = \explode('=',trim($value,' '));

                $quality[trim($res,' ')] = $id;
            }

            foreach ($quality as $key => $id) {
                $download_links[$id] = $this->generateDwonloadURL($single_movie,$id);
            }

        }

 
        return \view('pages.single',[
            'movie'           => $single_movie[0] ?? false,
            'category'        => $movie_categories,
            'seasions'         => $this->get_seasions_by_movie_id($id),
            'recomended'      => $recomended_movie,
            'reviews'         => $optimized_review,
            'download_url'    => $this->generateDwonloadURL($single_movie),
            'comments'        => $this->create_comment_markup_recursively(
                $this->get_comments_recursively($id)
            ),  
            'packages'           =>  $package = [
                'daily' => [
                    'price' => 10,
                    'features' => [
                        'Unlimited Download',
                        'Different Quality'
                    ],
                ],
                '6 month' => [
                    'price' => 40,
                    'features' => [
                        'Unlimited Download',
                        'Different Quality'
                    ],
                ],
                'monthly' => [
                    'price' => 90,
                    'features' => [
                        'Unlimited Download',
                        'Different Quality'
                    ],
                ]
            ],
            'qualities'     => $quality,
            'download_links'     => $download_links,
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
                        if ( \in_array( $_movie->id,$exclude ) ) continue;
                    } 

                    if ( \is_string($exclude) ) {
                        if ( $_movie->id == $exclude ) continue;
                    }

                    $unique_movie[] = [
                        'id'           => $_movie->id,
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


    protected function generateDwonloadURL( $single_movie,$id = null) {

        if ( $single_movie->count() == 0 ) return false;

        $drive_id = ($single_movie[0])->drive_id ?? '';
        $api_key = ($single_movie[0])->api_key ?? '';

        if ( $id ) {
            $drive_id = $id;
        }

        return "https://www.googleapis.com/drive/v3/files/$drive_id?alt=media&key=$api_key";
    }

    protected function get_comments_recursively ($movie_id,$parent = 0) 
    {
        $comments = Comment::where([
            ['comment_movie_id',$movie_id],
            ['comment_parent',$parent],
        ])->get();

        $crunchify_comments = [];

            if ($comments->count() > 0) {
                    foreach ($comments as $_comment) {
                        $crunchify_comments[] = [
                            'id' => $_comment->id,
                            'author' => $_comment->comment_author,
                            'comment_content' => $_comment->comment_content,
                            'comment_author_url' => $_comment->comment_author_url,
                            'comment_date' => $_comment->created_at->format('d M Y H:i a'),
                            'author_image' => $_comment->comment_author_image != " " ? $_comment->comment_author_image : asset('assets/img/user.svg'),
                            'reply'        => $this->get_comments_recursively($movie_id, $_comment->id)
                        ];
                    }
            }

        return $crunchify_comments;

    }

    protected function get_seasions_by_movie_id($id) 
      {     
        /**
         * Get all seasions unser $id this movie id
         */
        
        $seasionss = DB::table('movie_seasion_relationships')
                    ->join('seasions','seasions.id','=','movie_seasion_relationships.seasion_id')
                    ->where('movie_seasion_relationships.movie_id',$id)
                    ->get();
    
        $seasions_episodes = [];

        foreach ($seasionss as $seasions) {
            $episodes = DB::table('episodes')
                        ->join('seasions','seasions.id','=','episodes.seasions_id')
                        ->where('seasions.id',$seasions->id);

            if ( $episodes->count() == 0 ) continue;
            $seasions_episodes[$seasions->seasions_name] = [
                'seasions'         => $seasions,
                'episodes_count'   => $episodes->count(),
                'episodes'         => $episodes->get()
            ];
        }

        return $seasions_episodes;
                        
      }

    protected function create_comment_markup_recursively( $comments , $class = "comments__list" ) 
    {
          
        $comment_html = "<ul class='$class'>";
        
        foreach ($comments as $key => $_comment) {

            $comment_html .= sprintf("<li class='comments__item'>
                <div class='comments__autor'>
                    <img class='comments__avatar' src='%s' alt='Comment Autor'>
                    <span class='comments__name'>%s</span>
                    <span class='comments__time'>%s</span>
                </div>
                <p class='comments__text'>%s</p>
                <div class='comments__actions'>
                    <a href='#comment-form' type='button'  onclick=replay('%s')> <i class='fa fa-reply' aria-hidden='true'></i> Reply</a>
                </div>
            </li>",
                $_comment['author_image'],
                $_comment['author'],
                $_comment['comment_date'],
                $_comment['comment_content'],
                $_comment['id']
            );

            if ( ! empty($_comment['reply']) ) {
                $comment_html .= $this->create_comment_markup_recursively($_comment['reply'],'comments__list comment-list-child');
            }
        }

        $comment_html .= "</u>";

        return $comment_html;
    }

    protected function get_review_author ( $id = null) 
    {
        if ( ! $id ) {
            return Member::all();
        }

        if ( $id ) {
            return Member::where('id',$id)->first();
        }
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class FrontendController extends Controller
{
    public function add_comment(Request $request) 
    {
        $validation = Validator::make($request->all(), [

            'comment_author_email'  => 'required|email|unique:users,email',
            'comment_author'        => 'required|string|max:50',
            'comment_content'       => 'required|string',
            'comment_author_url'    => '',
            'comment_movie_id'      => 'required|numeric',
            'comment_parent'        => '',
            'comment_author_ip'     => '',

        ]);

        if ( $validation->fails() ) {
            return \redirect()->back()->withErrors($validation->errors()->all())->withInput();
        }

        $image = " "; //by default 

        $create_status = Comment::create([
            'comment_author_email'  => $request->comment_author_email,
            'comment_author'        => $request->comment_author,
            'comment_content'       => $request->comment_content,
            'comment_author_url'    => $request->comment_author_url,
            'comment_movie_id'      => $request->comment_movie_id,
            'comment_parent'        => $request->comment_parent,
            'comment_author_ip'     => $request->comment_author_ip,
            'comment_author_image'  => $image,
            'created_at'            => Carbon::now(),
        ]);

        if ( $create_status ) {
            return \redirect()->back()->with("Comment Added Successfully");
        }

    }

    public function add_review(Request $request) 
    {
        $validation = Validator::make($request->all(), [

            'review_title'      => 'required|string',
            'review_rate'       => 'required|numeric',
            'review_text'       => 'required|string',
            'review_author_id'  => 'required|numeric',
            'review_movie_id'  => 'required|numeric',

        ]);

        if ( $validation->fails() ) {
            return \redirect()->back()->withErrors($validation->errors()->all())->withInput();
        }

        $create_status = Review::create([
            'review_title'      => $request->review_title,
            'review_rate'       => $request->review_rate,
            'review_text'       => $request->review_text,
            'review_author'     => $request->review_author_id,
            'review_movie_id'   => $request->review_movie_id,
            'created_at'        => Carbon::now(),
            'status'            => 1,
        ]);

        if ( $create_status ) {
            return \redirect()->back()->with("Review Added Successfully");
        }
    }
}
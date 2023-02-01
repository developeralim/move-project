<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Movie;
use App\Models\Review;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{

      public function checkout(Request $request,$package,$price) {
            return \view('pages.checkout',  [
                  'package' => $package,
                  'price'   => $price,
            ]);
      }

      public function pricing(Request $request) {

            return \view('pages.pricing');
            
      }

      public function about( Request $request ) {
            
            return \view('pages.about');
      }

      public function contact( Request $request ) {
            return \view('pages.contact');
      }


      public function help( Request $request ) {

            return \view('pages.help');
      }

      public function terms(Request $request ) {

            return \view('pages.terms');
      }

      public function privecy(Request $request) {

            return \view('pages.privecy');

      }
}

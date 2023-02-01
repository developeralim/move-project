<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ViewShareMiddleware
{

    protected array $default_menu;
    protected array $nav_menu;
    protected array $page_options;
    public function __construct(  ) 
    {      
        $this->default_menu = [
            [
                'name'      => 'Home',
                'link'      => route('home')
            ],
            [
                'name'      => 'View Plan',
                'link'      =>  route('pricing')
            ],
            [
                'name'      => 'Help',
                'link'      =>  route('help')
            ],
        ];

        $this->nav_menu = $this->get_category_recursively();

        array_splice( $this->default_menu, 1, 0, $this->nav_menu );

        $this->page_options  = [
            'menu'                  => $this->navbar($this->default_menu),
            'show_lang_option'      => true,
            'is_expired'            => ( !Auth::guard('member')->check() ) || $this->is_user_expired(Auth::user()),
            'dateLeftToBeExpired'   => $this->is_user_expired(Auth::user(),'Asia/dhaka',true),
            'logged_in'             => $this->is_user_logged_in(),
            'logged_in_user'        => $this->get_logged_in_user(),
            'admin_contact'         => '+880 1722-654971',
            'admin_email'           => 'dmnnirob@gmail.com',
            'social_links'          => [
                    [     'name'      => 'facebook',
                            'icon'      => '<i class="fa-brands fa-facebook-f"></i>',
                            'link'      => '#'
                    ],
                    [
                            'name'      => 'instagram',
                            'icon'      => '<i class="fa-brands fa-instagram"></i>',
                            'link'      => '#'
                    ],
                    [
                            
                            'name'       => 'twitter',
                            'icon'      => '<i class="fa-brands fa-twitter"></i>',
                            'link'      => '#'
                    ],
                    [
                            'name'      => 'youtube',
                            'icon'      => '<i class="fa-brands fa-youtube"></i>',
                            'link'      => '#'
                    ],
                ],
            ];
    }



    public function handle(Request $request, Closure $next, ...$guards) {
        
        
        foreach ($this->page_options as $key => $option) {
            View::share($key,$option);
        } 
    
        return $next($request);

    }

   protected function get_category_recursively($parent = 0) 
    {
      $category = Category::where('parent',$parent)->get();

      $crunchify_category = [];

      if ($category->count() > 0 && ! empty($category)) {
            foreach ($category as $key => $single_category) {

                  if ( $single_category->status == 0 ) continue;

                  $crunchify_category[] = [
                        'id'         => $single_category->id,
                        'name'       => $single_category->name,
                        'slug'       => $single_category->slug,
                        'status'     => $single_category->status,
                        'description'=> $single_category->description,
                        'children'   => $this->get_category_recursively($single_category->id),
                        'link'       => \route('archive',[$single_category->id,$single_category->slug])
                  ];
            }
      }

      return $crunchify_category;
    } 

    /**
     * Create global menu for all view pages
     * @param array $category contains all category which is already added to database
     * @return string $menu
     */

    protected function navbar($category,$class='header__nav',$list_class='header__nav-item',$link_class="header__nav-link") {
             
        $nav_menu = "<ul class='$class'>";

            if ( ! empty($category) ) {

                foreach ($category as $key => $_category) {
                        
                    if ( isset($_category['children']) && ! empty ( $_category['children'] ) ) {

                        $attribute = 'class="dropdown-toggle '.$link_class.'"
                            role="button"
                            id="dropdownMenuCatalog"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        ';

                        $caret = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M17,9.17a1,1,0,0,0-1.41,0L12,12.71,8.46,9.17a1,1,0,0,0-1.41,0,1,1,0,0,0,0,1.42l4.24,4.24a1,1,0,0,0,1.42,0L17,10.59A1,1,0,0,0,17,9.17Z"/>
                        </svg>';

                    } else {
                            $caret      = "";
                            $attribute  = "class='$link_class'";
                    }

                    $nav_menu .= "<li class='$list_class'>
                            <a href='{$_category['link']}' $attribute >".$_category['name']." $caret</a>
                    ";
                    
                    if ( isset($_category['children']) && ! empty($_category['children']) ) 
                    {
                            $nav_menu .= $this->navbar($_category['children'],'dropdown-menu header__dropdown-menu','','');
                    }
                    
                    $nav_menu .= '</li>';

                }
                  
            }

        $nav_menu .= "</ul>";

        return $nav_menu;

      }

    protected function get_logged_in_user() 
    {
        if (! Auth::guard('member')->check()) {
                return [];
        }  

        return [
            'id' => Auth::user()->id,
            'name' => Auth::user()->user_name,
            'email' => Auth::user()->email,
            'package' => 'monthly'
        ];
    }

      protected function is_user_logged_in (  ) 
      {
        return Auth::guard('member')->check();
      }
      
      protected function get_date_interval($form_date) 
      {
        date_default_timezone_set('Asia/dhaka');

        $origin     = date_create($form_date);
        $target     = date_create(date('Y-m-d H:i:s'));
        $interval   = date_diff($origin,$target);
    
        return $interval;
      }
 

      // get time deference

      protected function __($interval,$p){
            return $interval->format("%$p");
      }


      protected function is_user_expired( $user,$timezone='Asia/dhaka',$show_on = false ) 
      {
        //by default return true 
        if ( ! $user ) return;
        // check time difference
        date_default_timezone_set($timezone);
    
        $origin     = date_create($user->created_at);
        $target     = date_create(date('Y-m-d H:i:s'));
        $interval   = date_diff($origin,$target);
    
        $year       = $interval->format('%y');
        $month      = $interval->format('%m');
        $day        = $interval->format('%d');
        $hour       = $interval->format('%h');
        $minute     = $interval->format('%i');
    
        $totalMinute = ( $year * 518400 ) + ($month * 43200) + ($day * 1440) + ($hour * 60) + $minute;
        
        $registered_at = $user->created_at;

        switch ( $user->package) {
                case 'daily':     
                    if ( $totalMinute >= 1440 ) {

                        return true;
                            
                    } else {
                            if ( $show_on ) {
                                $origin_extend    = date_create(date('Y-m-d H:i:s',strtotime($registered_at . ' +1 day ')));
                                $expired_intervel = date_diff($target,$origin_extend);
                                
                                return sprintf(
                                        "Expired at %s - <strong style=\"color:green;\">Time left %s hours %s minutes</strong>",
                                        date('d M Y',strtotime($registered_at . ' +1 day ')),
                                        $expired_intervel->format('%h'),
                                        $expired_intervel->format('%i')
                                );
                            }
                    }
    
                    break;
                case 'monthly':
                    if ( $totalMinute > 43200 ) {
                            return true;
                    } else {
                            if ( $show_on ) {
                                $origin_extend    = date_create(date('Y-m-d H:i:s',strtotime($registered_at . ' +30 days ')));
                                $expired_intervel = date_diff($target,$origin_extend);
                                
                                return sprintf(
                                        "Expired at %s - <strong style=\"color:green;\">Time left %s days %s hours %s minutes</strong>",
                                        date('d M Y',strtotime($registered_at . ' +30 days ')),
                                        $expired_intervel->format('%d'),
                                        $expired_intervel->format('%h'),
                                        $expired_intervel->format('%i')
                                );
        
                            }
                    }
                break;
            }
      
            return false;
      }

      

}

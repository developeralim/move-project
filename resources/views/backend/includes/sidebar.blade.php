<nav id="sidebar">
      <div class="shadow-bottom"></div>

      <ul class="list-unstyled menu-categories" id="accordionExample">

          <li class="menu">
              <a href="{{ route('admin.dashboard') }}" aria-expanded="false" class="dropdown-toggle " data-active="{{ Request::routeIs('admin.dashboard') ? 'true' : '' }}">
                  <div class="">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                      <span>Managed Dashboard</span>
                  </div>
              </a>
          </li>

          <li class="menu">
              <a href="{{ route('category.index') }}" aria-expanded="false" class="dropdown-toggle " data-active="{{ Request::routeIs('category.index') ? 'true' : '' }}">
                  <div class="">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                      <span>Managed categories</span>
                  </div>
              </a>
          </li>

          <li class="menu">
            <a href="#movies" data-toggle="collapse" aria-expanded="{{ Request::routeIs('color.index') ? 'true' : '' }}" data-active="{{ Request::routeIs('color.index') ? 'true' : '' }}" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                    <span>Manage Movies</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled" id="movies" data-parent="#accordionExample">
                <li>
                    <a href="{{ route('seasion.index') }}" data-active="{{ Request::routeIs('seasion.index') ? 'true' : '' }}">Seasion</a>
                </li>
                <li>
                    <a href="{{ route('movie.index') }}" data-active="{{ Request::routeIs('movie.index') ? 'true' : '' }}">Movies</a>
                </li>
                <li>
                    <a href="{{ route('episode.index') }}" data-active="{{ Request::routeIs('episode.index') ? 'true' : '' }}">Episodes</a>
                </li>
                <li>
                    <a href="{{ route('review.index') }}" data-active="{{ Request::routeIs('review.index') ? 'true' : '' }}">Reviews</a>
                </li>

            </ul>
         </li>
         <li class="menu">
            <a href="{{ route('user.index') }}" aria-expanded="false" class="dropdown-toggle " data-active="{{ Request::routeIs('user.index') ? 'true' : '' }}">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    <span>Managed Members</span>
                </div>
            </a>
        </li>
        <li class="menu">
            <a href="{{ route('comment.index') }}" aria-expanded="false" class="dropdown-toggle " data-active="{{ Request::routeIs('comment.index') ? 'true' : '' }}">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    <span>Managed Comments</span>
                </div>
            </a>
        </li>
        <li class="menu">
            <a href="#Settings" data-toggle="collapse" aria-expanded="" data-active="" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                    <span>Settings</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled" id="Settings" data-parent="#accordionExample">

                <li>
                    <a href="{{ route('option-setting') }}" data-active="{{ Request::routeIs('option-setting') ? 'true' : '' }}">Option Settings</a>
                </li>
                <li>
                    <a href="{{ route('profile') }}" data-active="{{ Request::routeIs('profile') ? 'true' : '' }}">Profile</a>
                </li>
                <li>
                    <a href="{{ route('password') }}" data-active="{{ Request::routeIs('password') ? 'true' : '' }}">Change Password</a>
                </li>


            </ul>
         </li>
      </ul>

  </nav>

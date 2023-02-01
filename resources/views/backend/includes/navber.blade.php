<header class="header navbar navbar-expand-sm">

      <ul class="navbar-item theme-brand flex-row  text-center">
          <li class="nav-item theme-text">
              <a href="{{ route('admin.dashboard') }}" class="nav-link"> Admin Dahboard </a>
          </li>
      </ul>

      <ul class="navbar-item flex-row ml-md-auto">

          <li class="nav-item dropdown user-profile-dropdown">
              <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                 @if (Auth::user()->image)
                 <img src="{{ asset(Auth::user()->image) }}" alt="avatar">
                 @else
                 <img src="{{ asset('backend') }}/assets/user/user.jpg" alt="avatar">
                 @endif
              </a>
              <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                  <div class="">
                      <div class="dropdown-item">
                          <a class="" href="{{ route('profile') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Profile</a>
                      </div>


                      <div class="dropdown-item">
                        @if (Auth::guard('admin')->check())
                          <a class="" href="{{ route('admin.logout') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Sign Out</a>
                            @endif
                      </div>
                  </div>
              </div>
          </li>
          </li>

      </ul>
  </header>


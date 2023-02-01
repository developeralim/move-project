<!DOCTYPE html>
<html lang="{{ app()->getlocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS -->
    <!-- google fonts -->
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css?family=Cinzel:400,700,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700&amp;display=swap" rel="stylesheet">
    <!-- font asesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    {{-- swipper slider --}}
    <!-- slider css end -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plyr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/photoswipe.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/default-skin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider.css') }}">
    {{-- video player --}}
    <link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet">
    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}" sizes="32x32">

    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keyword')">
    <meta name="author" content="@yield('author')">
    <title>@yield('title')</title>
</head>

<body class="body hamburger-menu dsn-effect-scroll dsn-ajax" data-dsn-mousemove="true">
    <!-- header -->
    <header class="header">
        <div class="header__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header__content">

                            <!-- header logo -->
                            <a href="{{ route('home') }}" class="header__logo">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                            </a>
                            <!-- end header logo -->

                            <!-- header nav -->
                            {!! $menu !!}
                            <!-- end header nav -->

                            <!-- header auth -->
                            <div class="header__auth">
                                <button class="header__search-btn" aria-label="search btn" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M21.71,20.29,18,16.61A9,9,0,1,0,16.61,18l3.68,3.68a1,1,0,0,0,1.42,0A1,1,0,0,0,21.71,20.29ZM11,18a7,7,0,1,1,7-7A7,7,0,0,1,11,18Z" />
                                    </svg>
                                </button>
                                <!-- dropdown -->
                                @if ($show_lang_option)
                                    <div class="dropdown header__lang">
                                        <a class="dropdown-toggle header__nav-link" href="#" role="button"
                                            id="dropdownMenuLang" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">EN</a>
                                        <ul class="dropdown-menu header__dropdown-menu"
                                            aria-labelledby="dropdownMenuLang">
                                            <li>
                                                <a href="#">English</a>
                                            </li>
                                            <li>
                                                <a href="#">Spanish</a>
                                            </li>
                                            <li>
                                                <a href="#">Russian</a>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                                <!-- end dropdown -->
                                @if ($logged_in)
                                    <a href="{{ route('dashboard') }}" class="header__sign-in dashboard_header">
                                        <i class="fa fa-user" aria-hidden="true" style="color: #fff;"></i>
                                        <span>Dashboard</span>
                                    </a>
                                @endif

                                @if (!$logged_in)
                                    <a href="{{ route('login') }}" class="header__sign-in">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="M20,12a1,1,0,0,0-1-1H11.41l2.3-2.29a1,1,0,1,0-1.42-1.42l-4,4a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l4,4a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L11.41,13H19A1,1,0,0,0,20,12ZM17,2H7A3,3,0,0,0,4,5V19a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V16a1,1,0,0,0-2,0v3a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V5A1,1,0,0,1,7,4H17a1,1,0,0,1,1,1V8a1,1,0,0,0,2,0V5A3,3,0,0,0,17,2Z" />
                                        </svg>
                                        <span>sign in</span>
                                    </a>
                                    <a style="margin-left:3px;" href="{{ route('pricing') }}" class="header__sign-in">
                                        <svg width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#fff" stroke-width="1" stroke-linecap="round" stroke-linejoin="miter"><polygon points="7 9 11 2 14 2 13 9 22 9 20 22 7 22 7 9"></polygon><rect x="2" y="9" width="5" height="13"></rect></svg>
                                        <span>Subscribe</span>
                                    </a>
                                @endif

                            </div>
                            <!-- end header auth -->
                            <!-- header menu btn -->
                            <button class="header__btn" type="button">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <!-- end header menu btn -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header search -->
        <form action="{{ route('search') }}" class="header__search">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header__search-content">
                            <input type="text" name="search" placeholder="I'm looking for...">
                            <button type="submit">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- end header search -->
    </header>
    <!-- end header -->

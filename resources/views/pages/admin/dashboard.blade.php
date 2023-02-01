@extends('pages.layouts.main')

@section('main')
    <!-- page title -->
    <section class="section section--first section--bg" data-bg="assets/img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h1 class="section__title">My Daag</h1>
                        <!-- end section title -->
                        <!-- breadcrumb -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb__item">
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb__item breadcrumb__item--active">Profile</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->
    <!-- content -->
    <div class="content">
        <!-- profile -->
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="profile__content">
                            <div class="profile__user">
                                <div class="profile__avatar">
                                    <img src="assets/img/user.svg" alt="">
                                </div>
                                <div class="profile__meta">
                                    <h3>{{ Auth::user()->user_name }}</h3>
                                    <span>{!! $dateLeftToBeExpired !!}</span>
                                </div>
                            </div>
                            <!-- content tabs nav -->
                            <ul class="nav nav-tabs content__tabs content__tabs--profile" id="content__tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#tab-1" role="tab"
                                        aria-controls="tab-1" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#tab-2" role="tab"
                                        aria-controls="tab-2" aria-selected="false">Subscription</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-toggle="tab" href="#tab-3" role="tab"
                                        aria-controls="tab-3" aria-selected="false">Settings</a>
                                </li>
                            </ul>
                            <!-- end content tabs nav -->
                            <!-- content mobile tabs nav -->
                            <div class="content__mobile-tabs content__mobile-tabs--profile" id="content__mobile-tabs">
                                <div class="content__mobile-tabs-btn dropdown-toggle" role="navigation" id="mobile-tabs"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <input type="button" value="Profile">
                                    <span></span>
                                </div>
                                <div class="content__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="1-tab" data-toggle="tab" href="#tab-1"
                                                role="tab" aria-controls="tab-1" aria-selected="true">Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="2-tab" data-toggle="tab" href="#tab-2"
                                                role="tab" aria-controls="tab-2" aria-selected="false">Subscription</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="3-tab" data-toggle="tab" href="#tab-3"
                                                role="tab" aria-controls="tab-3" aria-selected="false">Settings</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end content mobile tabs nav -->
                            <a href="{{ route('logout') }}" class="profile__logout" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M4,12a1,1,0,0,0,1,1h7.59l-2.3,2.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l4-4a1,1,0,0,0,.21-.33,1,1,0,0,0,0-.76,1,1,0,0,0-.21-.33l-4-4a1,1,0,1,0-1.42,1.42L12.59,11H5A1,1,0,0,0,4,12ZM17,2H7A3,3,0,0,0,4,5V8A1,1,0,0,0,6,8V5A1,1,0,0,1,7,4H17a1,1,0,0,1,1,1V19a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V16a1,1,0,0,0-2,0v3a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V5A3,3,0,0,0,17,2Z" />
                                </svg>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end profile -->
        <div class="container">
            <!-- content tabs -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade " id="tab-1" role="tabpanel" aria-labelledby="1-tab">
                    <div class="row row--grid"> </div>
                </div>
                <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab">
                    <div class="row row--grid" style="justify-content: center">
                        <!-- price -->
                        <div class="col-12 order-md-3 col-lg-4 order-lg-2">
                            <div class="price price--profile price--premium">
                                <div class="price__item price__item--first">
                                    <span>Premium</span>
                                    <span>$19.99</span>
                                </div>
                                <div class="price__item">
                                    <span>1 Month</span>
                                </div>
                                <div class="price__item">
                                    <span>Full HD</span>
                                </div>
                                <div class="price__item">
                                    <span>Lifetime Availability</span>
                                </div>
                                <div class="price__item">
                                    <span>TV & Desktop</span>
                                </div>
                                <div class="price__item">
                                    <span>24/7 Support</span>
                                </div>
                                <a href="#" class="price__btn">Choose Plan</a>
                            </div>
                        </div>
                        <!-- end price -->
                        <!-- price -->
                        <div class="col-12 col-md-6 order-md-2 col-lg-4 order-lg-3">
                            <div class="price price--profile">
                                <div class="price__item price__item--first">
                                    <span>Cinematic</span>
                                    <span>$39.99</span>
                                </div>
                                <div class="price__item">
                                    <span>2 Months</span>
                                </div>
                                <div class="price__item">
                                    <span>Ultra HD</span>
                                </div>
                                <div class="price__item">
                                    <span>Lifetime Availability</span>
                                </div>
                                <div class="price__item">
                                    <span>Any Device</span>
                                </div>
                                <div class="price__item">
                                    <span>24/7 Support</span>
                                </div>
                                <a href="#" class="price__btn">Choose Plan</a>
                            </div>
                        </div>
                        <!-- end price -->
                    </div>
                </div>
                <div class="tab-pane fade show active" id="tab-3" role="tabpanel" aria-labelledby="3-tab">
                    <div class="row row--grid">
                        <!-- details form -->

                        <div class="col-12 col-lg-6">

                            <form action="{{ route('update_member') }}"method="post" class="profile__form">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="profile__title">Profile details</h4>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="profile__group">
                                            <label class="profile__label" for="username">Name </label>
                                            <input id="username" type="text" name="user_name"
                                                value="{{ Auth::user()->user_name }}" class="profile__input"required
                                                placeholder="User 123">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="profile__group">
                                            <label class="profile__label" for="email">Email</label>
                                            <input id="email" type="text" name="email"
                                                value="{{ Auth::user()->email }}" class="profile__input"required
                                                placeholder="email@email.com">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="profile__group">
                                            <label class="profile__label" for="firstname">Phone </label>
                                            <input id="firstname" type="text" name="mobile_no"
                                                value="{{ Auth::user()->mobile_no }}" class="profile__input"required
                                                placeholder="John">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="profile__group">
                                            <label class="profile__label" for="lastname">City Name</label>
                                            <input id="lastname" type="text" name="city"
                                                value="{{ Auth::user()->city }}" class="profile__input"required
                                                placeholder="Doe">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="profile__group">
                                            <label class="profile__label" for="lastname">State Name</label>
                                            <input id="lastname" type="text" name="state"
                                                value="{{ Auth::user()->state }}" class="profile__input"required
                                                placeholder="Doe">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="profile__group">
                                            <label class="profile__label" for="lastname">Zip Code </label>
                                            <input id="lastname" type="text" name="zip"
                                                value="{{ Auth::user()->zip }}" class="profile__input" required
                                                placeholder="Doe">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="profile__group">
                                            <label class="profile__label" for="lastname">Address </label>
                                            <textarea name="address" id="" required class="profile__input" cols="50" rows="50">{{ Auth::user()->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="profile__btn" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <!-- end details form -->
                        <!-- password form -->
                        <div class="col-12 col-lg-6">
                            <form action="{{ route('update_password') }}" method="post" class="profile__form">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="profile__title">Change password</h4>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="profile__group">
                                            <label class="profile__label" for="oldpass">Old Password</label>
                                            <input id="oldpass" type="password" name="old_password" required
                                                class="profile__input">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="profile__group">
                                            <label class="profile__label" for="newpass">New Password</label>
                                            <input id="newpass" type="password" name="new_password" required
                                                class="profile__input">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="profile__group">
                                            <label class="profile__label" for="confirmpass">Confirm New Password</label>
                                            <input id="confirmpass" type="password" name="new_password_confirmation"
                                                required class="profile__input">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="profile__btn" type="submit">Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end password form -->

                    </div>
                </div>
            </div>
            <!-- end content tabs -->
        </div>
    </div>
    <!-- end content -->
@endsection

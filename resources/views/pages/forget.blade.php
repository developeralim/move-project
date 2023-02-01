@extends('pages.layouts.main')
@section('title')
   Daag | Forget Password
@endsection
@section('main')       
      <div class="sign section--bg" data-bg="assets/img/section/section.jpg">
            <div class="container">
                  <div class="row">
                        <div class="col-12">
                        <div class="sign__content">
                              <!-- authorization form -->
                              <form action="#" class="sign__form">
                                    <a href="index.html" class="sign__logo">
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="">
                                    </a>
                                    <div class="sign__group">
                                    <input type="text" class="sign__input" placeholder="Email">
                                    </div>
                                    <div class="sign__group sign__group--checkbox">
                                    <input
                                          id="remember"
                                          name="remember"
                                          type="checkbox"
                                          checked="checked"
                                    >
                                    <label for="remember">
                                          I agree to the
                                          <a href="{{route('privecy')}}">Privacy Policy</a>
                                    </label>
                                    </div>
                                    <button class="sign__btn" type="button">Sign in</button>
                                    <span class="sign__text">We will send a password to your Email</span>
                              </form>
                              <!-- end authorization form -->
                        </div>
                        </div>
                  </div>
            </div>
      </div>
@endsection

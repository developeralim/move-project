@extends('pages.layouts.main')
@section('title')
   Daag | Signup
@endsection
@section('main')
<div class="sign section--bg" data-bg="assets/img/section/section.jpg">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="sign__content">
                      <!-- registration form -->
                      <form action="#" class="sign__form">
                          <a href="index.html" class="sign__logo">
                              <img src="assets/img/logo.svg" alt="">
                          </a>
                          <div class="sign__group">
                              <input type="text" class="sign__input" placeholder="Name">
                          </div>
                          <div class="sign__group">
                              <input type="text" class="sign__input" placeholder="Email">
                          </div>
                          <div class="sign__group">
                              <input type="password" class="sign__input" placeholder="Password">
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
                                  <a href="privacy.html">Privacy Policy</a>
                              </label>
                          </div>
                          <button class="sign__btn" type="button">Sign up</button>
                          <span class="sign__text">
                              Already have an account?
                              <a href="signin.html">Sign in!</a>
                          </span>
                      </form>
                      <!-- registration form -->
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
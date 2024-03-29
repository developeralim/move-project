
@extends('pages.layouts.main')
@section('title')
    404 - page not found
@endsection
@section('main')
      <!-- page 404 -->
      <div class="page-404 section--bg" data-bg="{{asset('assets/img/section/section.jpg')}}">
            <div class="container">
                  <div class="row">
                        <div class="col-12">
                              <div class="page-404__wrap">
                              <div class="page-404__content">
                                    <h1 class="page-404__title">404</h1>
                                    <p class="page-404__text">The page you are looking for not available!</p>
                                    <a href="{{route('home')}}" class="page-404__btn">go back</a>
                              </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
@endsection


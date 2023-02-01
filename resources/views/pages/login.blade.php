@extends('pages.layouts.main')
@section('title')
   Daag | Login
@endsection
@section('main')
    <div class="sign section--bg" data-bg="assets/img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- authorization form -->
                        <form action="{{ route('member.login') }}" method="POST" class="sign__form">
                            @csrf
                            <a href="index.html" class="sign__logo">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                            </a>
                            <div class="sign__group">
                                <input type="text" name="email" class="sign__input" placeholder="Email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                @if (session('fail'))
                                    <span class="error">{{ session('fail') }}</span>
                                @endif
                            </div>
                            <div class="sign__group">
                                <input type="password" name="password" class="sign__input" placeholder="Password">
                                @error('password')
                                    <span class="sign__text">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="sign__btn" type="submit">Sign in</button>
                            <span class="sign__text">
                                Don't have an account?
                                <a href="{{ route('pricing') }}">Sign up!</a>
                            </span>
                            <span class="sign__text">
                                <a href="{{route('forget')}}">Forgot password?</a>
                            </span>
                        </form>
                        <!-- end authorization form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

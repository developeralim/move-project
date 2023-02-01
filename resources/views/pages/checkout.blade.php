@extends('pages.layouts.main')
@section('title')
   Daag | Checkout
@endsection
@section('main')
    <!-- page title -->
    <section class="section section--first section--bg" data-bg="assets/img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h1 class="section__title">Checkout -- {{ $package }} package</h1>
                        <!-- end section title -->
                        <!-- breadcrumb -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb__item">
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb__item breadcrumb__item--active">৳{{ $price }}</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->
    <div class="container page-section">
        <form action="{{ route('payment') }}" method="POST" class="form mb-4" id="comment-form">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <p class="error">{{ $error }}</p>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h3 class='title my-2'>Personal Information</h3>
            <div class="row">
                <div class="col">
                    <input id="first_name" name="first_name" placeholder="First Name" value="{{ old('first_name') }}"
                        class="form__input" />
                </div>
                <div class="col">
                    <input type="text" id="last_name" name="last_name" placeholder="Last Name"
                        value="{{ old('last_name') }}" class="form__input" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}"
                        class="form__input" />
                </div>
                <div class="col">
                    <input type="tel" id="phone" name="mobile_no" placeholder="Phone Number"
                        value="{{ old('mobile_no') }}" class="form__input" />
                </div>
            </div>

            <h3 class='title my-2'>Billing Information</h3>

            <input id="adr" placeholder="Address" name="address" class="form__input" value="{{ old('address') }}" />

            <input id="city" placeholder="City" name="city" class="form__input" value="{{ old('city') }}" />

            <input placeholder="State" name="state" class="form__input" value="{{ old('state') }}" />

            <input placeholder="Zip Code" name="zip" class="form__input" value="{{ old('zip') }}" />

            <h3 class='title my-2'>Account Security</h3>

            <input type="password" id="password" name="password" placeholder="Password" value="{{ old('Password') }}"
                class="form__input" />

            <input type="password" id="passowrd-confirm" name="confirm_password" value="{{ old('confirm_password') }}"
                placeholder="Password Confirm" class="form__input" />

            {{-- hidden inputs --}}
            <input type="hidden" name="package" value="{{ $package }}">
            <input type="hidden" name="price" value="{{ $price }}">
            <input type="hidden" name="coupon" value="">
            <input type="hidden" name="discount" value="">

            <button type="submit" class="form__btn paybtn" style="width:30%;">Continue To Pay</button>
        </form>
    </div>
@endsection

@extends('backend.layouts.app')
@section('page_name')
    Profile
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Movie Option Settings:-
                        </h4>
                        <hr>
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif
                        <form action="{{ route('option-setting-post') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">Admin Two Step Varification code : </label>
                                        <input id="my-input" class="form-control" type="text" name="varification_code"
                                            value="{{ $option_modify['varification_code'] ?? '' }}"
                                            placeholder="Admin Two Step Varification code....">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">Site Home Page : </label>
                                        <input id="my-input" class="form-control" type="text" name="home_page"
                                            placeholder="Site Home page...." value="{{ $option_modify['home_page'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">Site login page : </label>
                                        <input id="my-input" class="form-control" type="text" name="login_page"
                                            placeholder="Site login page...." value="{{ $option_modify['login_page'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">Footer text : </label>
                                        <input id="my-input" class="form-control" type="text" name="footer_text"
                                            placeholder="Footer text here...." value="{{ $option_modify['footer_text'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">Admin Contact No : </label>
                                        <input id="my-input" class="form-control" type="number" name="contact_no"
                                            placeholder="Admin Contact No...."value="{{ $option_modify['contact_no'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">Send Mail Author : </label>
                                        <input id="my-input" class="form-control" type="text" name="mail_author"
                                            placeholder="Send Mail Author...."value="{{ $option_modify['mail_author'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">Facebook Link : </label>
                                        <input id="my-input" class="form-control" type="text" name="fb_link"
                                            placeholder="Facebook Link...." value="{{ $option_modify['fb_link'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">Linkedin Link : </label>
                                        <input id="my-input" class="form-control" type="text" name="linkedin_link"
                                            placeholder="Linkedin Link ...." value="{{ $option_modify['linkedin_link'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">Github Link : </label>
                                        <input id="my-input" class="form-control" type="text" name="github_link"
                                            placeholder=" Github Link ...." value="{{ $option_modify['github_link'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">Instagram Link : </label>
                                        <input id="my-input" class="form-control" type="text" name="insta_link"
                                            placeholder=" Instagram Link ...." value="{{ $option_modify['insta_link'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">Twitter Link : </label>
                                        <input id="my-input" class="form-control" type="text" name="twitter_link"
                                            placeholder=" Twitter Link ...." value="{{ $option_modify['twitter_link'] ?? '' }}">
                                    </div>
                                </div>

                            </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Payment Option Settings:-
                        </h4>
                        <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">SSL Commerce Store ID : </label>
                                        <input id="my-input" class="form-control" type="text"
                                            name="store_id"placeholder="SSL Commerce Store ID ...." value="{{ $option_modify['store_id'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">SSL Commerce Store password : </label>
                                        <input id="my-input" class="form-control" type="text"
                                            name="password"placeholder="SSL Commerce Store password ...." value="{{ $option_modify['password'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">SSL Commerce success URL : </label>
                                        <input id="my-input" class="form-control" type="text"
                                            name="success_url"placeholder="SSL Commerce success URL ...." value="{{ $option_modify['success_url'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">SSL Commerce fail URL : </label>
                                        <input id="my-input" class="form-control" type="text"
                                            name="fail_url"placeholder="SSL Commerce fail URL ...." value="{{ $option_modify['fail_url'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">SSL Commerce Cancel URL : </label>
                                        <input id="my-input" class="form-control" type="text"
                                            name="cancle_url"placeholder="SSL Commerce Cancel URL ...." value="{{ $option_modify['cancle_url'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="my-input">API endpoints : </label>
                                        <input id="my-input" class="form-control" type="text"
                                            name="api"placeholder="API endpoints ...."  value="{{ $option_modify['api'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary float-right">Update data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

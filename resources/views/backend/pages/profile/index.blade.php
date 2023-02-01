@extends('backend.layouts.app')
@section('page_name')
    Profile
@endsection
@push('style')
    <style>
        .img-cicle {
            border-radius: 100%;
            margin-bottom: 20px;
            margin-left: 20px;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <span>{{ session('success') }}</span>
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="upload mt-4 mb-5 pr-md-4 text-center">
                            <form action="{{ route('profile.image.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (Auth::user()->image)
                                    <img src="{{ asset(Auth::user()->image) }}" class="img-cicle text-center" width="170px"
                                        height="170px" alt="">
                                @else
                                    <img src="{{ asset('backend/assets/user/user.jpg') }}" class="img-cicle" width="170px"
                                        height="170px" alt="">
                                @endif

                                <br>
                                <br>
                                <input type="file" id="" name="image" class="form-control @error('image')is-invalid

                                @enderror"  placeholder="Change your image"/>
                                @error('image')
                                    <span class="text-danger font-weight-bolder font-italic ">{{ $message }}</span>
                                @enderror
                                <br>
                                <button type="submit" class="btn btn-lg btn-primary">Picture Change Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Edit Details
                        </h5>
                        @if (session('success_details'))
                        <div class="alert alert-success" role="alert">
                            <span>{{ session('success_details') }}</span>
                        </div>
                        @endif
                        <form action="{{ route('profile.details.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                          <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="my-input">Name</label>
                                    <input id="my-input" class="form-control" type="text" name="name" value="{{ Auth::user()->name }}">
                                    @error('name')
                                    <span class="text-danger font-weight-bolder font-italic ">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="my-input">Email</label>
                                    <input id="my-input" class="form-control" type="text" name="email" value="{{ Auth::user()->email }}">
                                    @error('email')
                                    <span class="text-danger font-weight-bolder font-italic ">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="my-input">City</label>
                                    <input id="my-input" class="form-control" type="text" name="city" value="{{ Auth::user()->city }}" placeholder="City">
                                    @error('city')
                                    <span class="text-danger font-weight-bolder font-italic ">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="my-input">State</label>
                                    <input id="my-input" class="form-control" type="text" name="state" value="{{ Auth::user()->state }}" placeholder="State">
                                    @error('state')
                                    <span class="text-danger font-weight-bolder font-italic ">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="my-input">ZIP Code</label>
                                    <input id="my-input" class="form-control" type="number" name="zip" value="{{ Auth::user()->zip }}" placeholder="zip">
                                    @error('zip')
                                    <span class="text-danger font-weight-bolder font-italic ">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="my-input">Phone</label>
                                    <input id="my-input" class="form-control" type="number" name="phone" value="{{ Auth::user()->phone }}" placeholder="phone">
                                    @error('phone')
                                    <span class="text-danger font-weight-bolder font-italic ">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="my-input">Description || Address</label>
                                   <textarea name="address" id="" class="form-control" cols="4" rows="4">{{Auth::user()->address  }}</textarea>
                                    @error('address')
                                    <span class="text-danger font-weight-bolder font-italic ">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                          </div>

                                <button type="submit" class="btn btn-lg btn-success float-right">Please  Click Submit Button</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

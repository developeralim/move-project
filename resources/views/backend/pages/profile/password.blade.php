
@extends('backend.layouts.app')
@section('page_name')
    Profile
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                           Change your password
                    </h4>
                    @if (session('success_password'))
                    <div class="alert alert-success" role="alert">
                        <span>{{ session('success_password') }}</span>
                    </div>
                    @endif
                    <form action="{{ route('profile.password.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                      <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="my-input">Old password</label>
                                <input id="my-input" class="form-control" type="password" name="old_password">
                                @error('old_password')
                                <span class="text-danger font-weight-bolder font-italic ">{{ $message }}</span>
                            @enderror
                            @if (session('error_password'))
                            <span class="text-danger font-weight-bolder font-italic ">{{ session('error_password') }}</span>
                            @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="my-input">New password</label>
                                <input id="my-input" class="form-control" type="password" name="new_password">
                                @error('new_password')
                                <span class="text-danger font-weight-bolder font-italic ">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="my-input">Confirm password</label>
                                <input id="my-input" class="form-control" type="password" name="new_password_confirmation">
                                @error('new_password_confirmation')
                                <span class="text-danger font-weight-bolder font-italic ">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                      </div>
                      <br>
                            <button type="submit" class="btn btn-lg btn-secondary float-right">Change Password</button>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

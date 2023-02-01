@extends('backend.layouts.app')
@section('title')
Dashboard
@endsection
@section('page_name')
Dashboard
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 mb-3">
            <div class="card component-card_1">
                <div class="card-body">
                    <h5 class="card-title">Total Registred Members</h5>
                    <h1 class="card-text font-weight-bolder">{{ $user }}</h1>
                </div>
            </div>
           </div>
           <div class="col-md-3 mb-3">
            <div class="card component-card_1">
                <div class="card-body">
                    <h5 class="card-title">Total categories</h5>
                    <h1 class="card-text font-weight-bolder">{{ $category }}</h1>

                </div>
            </div>
           </div>


           <div class="col-md-3 mb-3">
            <div class="card component-card_1">
                <div class="card-body">
                    <h5 class="card-title">Total movies</h5>
                    <h1 class="card-text font-weight-bolder">{{ $movie }}</h1>
                </div>
            </div>
           </div>
           <div class="col-md-3 mb-3">
            <div class="card component-card_1">
                <div class="card-body">
                    <h5 class="card-title">Total seasions</h5>
                    <h1 class="card-text font-weight-bolder">{{ $seasion }}</h1>
                </div>
            </div>
           </div>
           <div class="col-md-3 mb-3">
            <div class="card component-card_1">
                <div class="card-body">
                    <h5 class="card-title">Total episodes</h5>
                    <h1 class="card-text font-weight-bolder">{{ $episode }}</h1>
                </div>
            </div>
           </div>
           <div class="col-md-3 mb-3">
            <div class="card component-card_1">
                <div class="card-body">
                    <h5 class="card-title">Total reviews</h5>
                    <h1 class="card-text font-weight-bolder">{{ $review }}</h1>
                </div>
            </div>
           </div>
           <div class="col-md-3 mb-3">
            <div class="card component-card_1">
                <div class="card-body">
                    <h5 class="card-title">Total comments</h5>
                    <h1 class="card-text font-weight-bolder">{{ $comment }}</h1>
                </div>
            </div>
           </div>

        </div>
    </div>
@endsection




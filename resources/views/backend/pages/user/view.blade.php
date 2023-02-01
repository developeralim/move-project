@extends('backend.layouts.app')
@section('title')
Dashboard
@endsection
@push('style')
    <style>
        .img-cicle {
            border-radius: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
@endpush
@section('page_name')
Members
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 m-auto text-center">
                <div class="card">
                    <div class="card-header">

                        <a class="btn btn-rounded btn-sm btn-success  float-right  "
                        href="{{ route('user.index') }}">Members lists</a>
                    </div>

                    <div class="card-body">
                              <!---- Branch View table  ----->

                            <h3 class="card-title font-weight-bolder font-italic text-info">

                                    {{ Str::title($member->user_name)}}-details
                                    <br>
                                    <img src="{{ asset('backend/assets/user/user.jpg') }}" class="img-cicle" width="170px"
                                        height="170px" alt="">

                            </h3>
                            <table class="table table-bordered table-striped">
                                <tbody >
                                    <tr>
                                        <th>Member name</th>
                                        <th>{{ Str::title($member->user_name)}}</th>
                                    </tr>
                                    <tr>
                                        <th>Member Email</th>
                                        <th>{{ $member->email }}</th>
                                    </tr>
                                    <tr>
                                        <th>Member mobile no</th>
                                        <th>{{ $member->mobile_no }}</th>
                                    </tr>
                                    <tr>
                                        <th>Membership Payment ID</th>
                                        <th>{{ $member->payment_id }}</th>
                                    </tr>
                                    <tr>
                                        <th>Membership Payment GatWay</th>
                                        <th>{{ $member->payment_gateway }}</th>
                                    </tr>
                                    <tr>
                                        <th>Membership code</th>
                                        <th>{{ $member->membership_code }}</th>
                                    </tr>
                                    <tr>
                                        <th>Membership transection docs</th>
                                        <th>{{ $member->transection_doc }}</th>
                                    </tr>
                                    <tr>
                                        <th>Membership coupon</th>
                                        <th>@if ($member->coupon)
                                            {{ $member->coupon }}
                                        @else
                                        <span class="badge badge-pill badge-danger">No Cupon</span>
                                        @endif</th>
                                    </tr>
                                    <tr>
                                        <th>Membership address</th>
                                        <th>@if ($member->address)
                                            {{ $member->address }}
                                        @else
                                        <span class="badge badge-pill badge-danger">No address</span>
                                        @endif</th>
                                    </tr>
                                    <tr>
                                        <th>Membership user location</th>
                                        <th>@if ($member->user_location_details)
                                            {{ $member->user_location_details }}
                                        @else
                                        <span class="badge badge-pill badge-danger">No user location</span>
                                        @endif</th>
                                    </tr>
                                    <tr>
                                        <th>Membership user city</th>
                                        <th>@if ($member->city)
                                            {{ $member->city }}
                                        @else
                                        <span class="badge badge-pill badge-danger">No  city</span>
                                        @endif</th>
                                    </tr>
                                    <tr>
                                        <th>Membership user state</th>
                                        <th>@if ($member->state)
                                            {{ $member->state }}
                                        @else
                                        <span class="badge badge-pill badge-danger">No  state</span>
                                        @endif</th>
                                    </tr>
                                    <tr>
                                        <th>Membership user zip</th>
                                        <th>@if ($member->zip)
                                            {{ $member->zip }}
                                        @else
                                        <span class="badge badge-pill badge-danger">No  zip</span>
                                        @endif</th>
                                    </tr>
                                    <tr>
                                        <th>Membership package</th>
                                        <th>@if ($member->package)
                                            {{ $member->package }}
                                        @else
                                        <span class="badge badge-pill badge-danger">No package</span>
                                        @endif</th>
                                    </tr>
                                    <tr>
                                        <th>Membership invoice code</th>
                                        <th>@if ($member->invoice_code)
                                            {{ $member->invoice_code }}
                                        @else
                                        <span class="badge badge-pill badge-danger">No invoice code</span>
                                        @endif</th>
                                    </tr>
                                    <tr>
                                        <th>Membership Price</th>
                                        <th>{{ $member->price }}</th>
                                    </tr>
                                    <tr>
                                        <th>Membership discount</th>
                                        <th>@if ($member->discount)
                                            {{ $member->discount }}
                                        @else
                                        <span class="badge badge-pill badge-danger">No discount</span>
                                        @endif</th>
                                    </tr>
                                    <tr>
                                        <th>Membership total</th>
                                        <th>{{ $member->total }}</th>
                                    </tr>

                                    <tr>
                                        <th>Membership status paid</th>
                                        <th>@if ($member->status_paid=='Unpaid')
                                           <span class="badge badge-pill badge-danger"> Unpaid</span>
                                            @else
                                            <span class="badge badge-pill badge-success">paid</span>
                                            @endif</th>
                                    </tr>
                                    <tr>
                                        <th>Membership Status</th>
                                        <th>@if ($member->status==1)
                                           <span class="badge badge-pill badge-success"> Active</span>
                                            @else
                                            <span class="badge badge-pill badge-danger"> Deactive</span>
                                            @endif</th>
                                    </tr>
                                   
                                </tbody>
                            </table>


                <!---- /Branch View table ----->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

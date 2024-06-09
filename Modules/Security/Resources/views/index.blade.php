@extends('admin.layouts.app')
@section('content')
<div class="dash-home-cards">
    <div class="row row-cols-xxl-4 row-cols-xl-3 row-cols-md-2 row-cols-1 top-cards">
        <div class="col-md-6 col-lg-4 col-xl-3 mb-25 mb-lg-45">
            <div class="card">
                <a class="card-body" href="{{url('security/blacklist')}}">
                    <p class="cart-title">Blackists</p>
                    <div class="card-results">
                        <h5 class="main-results"></h5>
                        <p class="perstant-result text-success"><i class=""></i> </p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3 mb-25 mb-lg-45">
            <div class="card">
                <a class="card-body" href="{{url('security/rule')}}">
                    <p class="cart-title">Rules</p>
                    <div class="card-results">
                        <h5 class="main-results"></h5>
                        <p class="perstant-result text-success"><i class=""></i> </p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3 mb-25 mb-lg-45">
            <div class="card">
                <a class="card-body" href="{{url('security/whitelist')}}">
                    <p class="cart-title">Whitelists</p>
                    <div class="card-results">
                        <h5 class="main-results"></h5>
                        <p class="perstant-result text-success"><i class=""></i> </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
<!-- Style Css -->
<link rel="stylesheet" href="{{ asset('public/dashboard-assets/css/pages-css/index.css') }}" />
@endpush
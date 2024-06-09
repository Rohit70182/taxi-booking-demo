@extends('admin.layouts.app')

@section('content')
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="acive">Seo</li>
        <li class="mx-1">/</li>
        <li class="active">Index</li>
    </ul>
</div>
<div class="dash-home-cards">
    <div class="row row-cols-xxl-4 row-cols-xl-3 row-cols-md-2 row-cols-1 top-cards">
        <div class="col-md-6 col-lg-4 col-xl-3 mb-20">
            <a href="{{url('logActivity')}}">
                <div class="card">
                    <div class="value white">
                        <p class="cart-title mb-2">Analytics</p>
                        <h5 class="main-results">{{\Modules\Seo\Entities\Analytics::count()}}</h5>
                    </div>
                    <div class="symbol">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3 mb-20">
            <a href="{{url('totalusers')}}">
                <div class="card">
                    <div class="value white">
                        <p class="cart-title mb-2">Seo</p>
                        <h5 class="main-results">{{\Modules\Seo\Entities\Seo::count()}}</h5>
                    </div>
                    <div class="symbol">
                        <i class="fas fa-key"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection

@push('styles')
<!-- Style Css -->
<link rel="stylesheet" href="{{ asset('public/dashboard-assets/css/pages-css/index.css') }}" />
@endpush
@push('scripts')
@endpush
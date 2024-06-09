@extends('admin.layouts.app')

@section('content')
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">Details</li>
    </ul>
</div>
<div class="dash-home-cards">
    <div class="row row-cols-xxl-4 row-cols-xl-3 row-cols-md-2 row-cols-1 top-cards">
        <div class="col-md-6 col-lg-4 col-xl-3 mb-20">
            <a href="{{url('/stripe/cards')}}">
                <div class="card">
                    <div class="value white">
                        <p class="cart-title mt-3">Cards</p>
                    </div>
                    <div class="symbol">
                        <i class="fas fa-id-card"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3 mb-20">
            <a  href="{{url('/stripe/payments')}}">
                <div class="card">
                    <div class="value white">
                        <p class="cart-title mt-3">Payments</p>
                    </div>
                    <div class="symbol">
                    <i class="fas fa-money-bill-wave-alt"></i>
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
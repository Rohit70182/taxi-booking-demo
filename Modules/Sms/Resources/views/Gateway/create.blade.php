@extends('admin.layouts.app')
@section('content')


<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">{{ isset($redirect) ? 'Update' : 'Details' }}</li>
    </ul>
</div>

<div class="card">
    <div class="card-body">

        <form method="post" action="{{url('/sms/gateway/account')}}">
            @csrf
            <input type="hidden" name="id" value="{{$id}}">
            <input type="hidden" name="title" value="{{$title}}">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label></label>
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <label>Twilio account sid</label>
                        <input type="text" class="form-control @error('twilio_account_sid') is-invalid @enderror" name="twilio_account_sid" value="{{ isset($redirect) ? $redirect->title : '' }}">
                        @error('twilio_account_sid')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Twilio account token</label>
                        <input type="text" class="form-control @error('twilio_account_token') is-invalid @enderror" name="twilio_account_token" value="{{ isset($redirect) ? $redirect->title : '' }}">
                        @error('twilio_account_token')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Phone number</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ isset($redirect) ? $redirect->title : '' }}">
                        @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>



                </div>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-bg">
            </div>
        </form>
    </div>
</div>

@endsection
@extends('admin.layouts.app')
@section('content')
<?php

use Modules\Sms\Entities\Gateway;
?>
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">Update Gateway</li>
    </ul>
</div>
<div class="card">
    <div class="card-body">
        <form method="post" action="{{url('/sms/gateway/update/'.$gateway->id)}}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{$gateway->title}}">
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Twilio account sid</label>
                        <input type="text" class="form-control" name="twilio_account_sid" value="{{$sid}}">
                        @error('twilio_account_sid')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Twilio account token</label>
                        <input type="text" class="form-control" name="twilio_account_token" value="{{$token}}">
                        @error('twilio_account_token')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Phone number</label>
                        <input type="text" class="form-control" name="phone" value="{{$phone}}">
                        @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <select id="gateway-state_id" class="form-control" name="state_id" aria-required="true" aria-invalid="false">
                            <option value="">Choose...</option>
                            <option value="{{Gateway::STATE_NEW}}" {{$gateway->state_id == Gateway::STATE_NEW ? 'selected' : ''}}>New</option>
                            <option value="{{Gateway::STATE_ACTIVE}}" {{$gateway->state_id == Gateway::STATE_ACTIVE ? 'selected' : ''}}>Active</option>
                            <option value="{{Gateway::STATE_ARCHIVED}}" {{$gateway->state_id == Gateway::STATE_ARCHIVED ? 'selected' : ''}}>Archived</option>
                        </select>
                        @error('state_id')
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
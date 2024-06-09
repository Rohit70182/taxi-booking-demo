@extends('admin.layouts.app')
@section('content')

<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">{{ isset($redirect) ? 'Update' : 'Add' }}</li>
    </ul>
</div>
<div class="card ">
    <div class="card-body">
        <form method="get" action="{{url('/sms/gateway/store')}}" enctype="multipart/form-data">

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ isset($redirect) ? $redirect->title : '' }}">
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Gateway Type</label>
                        <select id="gateway-type_id" class="form-control @error('type_id') is-invalid @enderror" name="type_id" aria-invalid="false">
                            <option value=""></option>
                            <option value="0">Twilio</option>
                        </select>
                        @error('type_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>State</label>
                        <select id="gateway-state_id" class="form-control @error('state_id') is-invalid @enderror" name="state_id" aria-required="true" aria-invalid="false">
                            <option value=""></option>
                            <option value="0">New</option>
                            <option value="1">Active</option>
                            <option value="2">Archived</option>
                        </select>
                        @error('state_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group text-right">
                <input type="submit" class="btn btn-bg">
            </div>
        </form>
    </div>

</div>

@endsection
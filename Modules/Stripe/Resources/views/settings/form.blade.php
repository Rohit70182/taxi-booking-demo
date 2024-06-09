@extends('admin.layouts.app')
@section('content')
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">Add Managers</li>
    </ul>
</div>
<div class="card">
    <div class="card-body">
        <form method="post" action="{{url('/stripe/settings/store')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ isset($settings) ? $settings->id : '' }}">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Publishable Key</label>
                        <input type="text" class="form-control" name="publishable_key" value="{{ isset($settings) ? $settings->publishable_key : '' }}" required>
                        {!!$errors->first("publishable_key", "<span class='text-danger'>message</span>")!!}
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Secret Key</label>
                        <input type="text" class="form-control" name="secret_key" value="{{ isset($settings) ? $settings->secret_key : '' }}" required>
                        {!!$errors->first("publishable_key", "<span class='text-danger'>message</span>")!!}
                    </div>
                </div>
            </div>
            <div class="text-right">
                <div class="form-group">
                    <input type="submit" class="btn btn-bg" name="submit" value="submit">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
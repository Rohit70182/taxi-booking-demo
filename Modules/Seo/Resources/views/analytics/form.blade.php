@extends('admin.layouts.app')
@section('content')
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="acive">Seo</li>
        <li class="mx-1">/</li>
        <li class="active">{{ isset($analytics) ? 'Update' : 'Add' }}</li>
    </ul>
</div>
<div class="card">
    <div class="card-header">
        <div class="ProfileHader d-flex flex-wrap align-items-center">
            <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Add</h3>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="{{url('/seo/analytics/store')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ isset($analytics) ? $analytics->id : '' }}">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Account</label>
                        <input type="text" class="form-control" name="account" value="{{ isset($analytics) ? $analytics->account : '' }}" required>
                        {!!$errors->first("account", "<span class='text-danger'>message</span>")!!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Domain Name</label>
                        <input type="text" class="form-control" name="domain_name" value="{{ isset($analytics) ? $analytics->domain_name : '' }}" required>
                        {!!$errors->first("domain_name", "<span class='text-danger'>message</span>")!!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="type_id" class="form-control" required>
                            <option>Select</option>
                            <option value="0" {{ isset($analytics) && $analytics->type_id == "0" ? 'selected' : '' }}>Google Analytics</option>
                        </select>
                        {!!$errors->first("status", "<span class='text-danger'>message</span>")!!}
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
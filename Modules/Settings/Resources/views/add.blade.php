@extends('admin.layouts.app')
@section('content')
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">Manage</li>
        <li class="mx-1">/</li>
        <li class="active">Settings</li>
    </ul>
</div>
<div class="card">
    <div class="card-header">
        <div class="page-head-text">
            <div class="ProfileHader d-flex flex-wrap align-items-center">
                <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Add Variables</h3>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="{{url('settings/save')}}">
            @csrf
            <div class="row align-items-start">
                <div class="col-md-6 col-lg-4">
                    <div class="form-group">
                        <label>Module</label>
                        <label>{{__('Status')}}</label>
                        <select name="module" class="form-control">
                            <option value="">Choose...</option>
                            @foreach($settingVariable as $value => $name)
                            <option value="{{$value}}">{{$name}}</option>
                            @endforeach
                        </select>
                        {!!$errors->first("module", "<span class='text-danger'>:message</span>")!!}
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group">
                        <label>Key</label>
                        <input type="text" class="form-control" name="key">
                        {!!$errors->first("key", "<span class='text-danger'>:message</span>")!!}
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="form-group">
                        <label>Value</label>
                        <input type="text" class="form-control" name="value">
                        {!!$errors->first("value", "<span class='text-danger'>:message</span>")!!}
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <div class="form-group">
                        <input type="submit" class="btn btn-bg" name="save" value="save">
                    </div>
                </div>
            </div>



        </form>
    </div>
</div>
@endsection
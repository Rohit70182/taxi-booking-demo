@extends('admin.layouts.app')
@section('content')
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="acive">Seo</li>
        <li class="mx-1">/</li>
        <li class="active">{{ isset($redirect) ? 'Update' : 'Add' }}</li>
    </ul>
</div>
<div class="card">
    <div class="card-header">
        <div class="ProfileHader d-flex flex-wrap align-items-center">
            <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Add</h3>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="{{url('/seo/redirect/store')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ isset($redirect) ? $redirect->id : '' }}">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{ isset($redirect) ? $redirect->title : '' }}" required>
                        {!!$errors->first("account", "<span class='text-danger'>message</span>")!!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>New url</label>
                        <input type="text" class="form-control" name="new_url" value="{{ isset($redirect) ? $redirect->new_url : '' }}" required>
                        {!!$errors->first("domain_name", "<span class='text-danger'>message</span>")!!}
                    </div>
                </div>
            </div>

            <div class="form-group text-right">
                <input type="submit" class="btn btn-bg" name="submit" value="submit">
            </div>
        </form>
    </div>
</div>

@endsection
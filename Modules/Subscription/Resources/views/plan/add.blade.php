@extends('admin.layouts.app')
@section('content')
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">Add Plan</li>
    </ul>
</div>
<div class="card">
    <div class="card-header">
        <div class="ProfileHader d-flex flex-wrap align-items-center">
            <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Add Plan </h3>

        </div>
    </div>
    <div class="card-body">
        <form method="post" action="{{url('/subscription/plan/store')}}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        {!!$errors->first("title", "<span class='text-danger'>:message</span>")!!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Plan Type</label>
                        <select name="type" class="form-control">
                            <option value="">Choose Plans</option>
                            <option value="0">Monthly</option>
                            <option value="1">Yearly</option>
                        </select>
                        {!!$errors->first("type", "<span class='text-danger'>:message</span>")!!}
                    </div>
                </div>
                <div class="col-lg-4">

                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description">
                        {!!$errors->first("description", "<span class='text-danger'>:message</span>")!!}
                    </div>
                </div>
                <div class="col-lg-4">

                    <div class="form-group">
                        <label>Validity</label>
                        <input type="text" class="form-control" name="validity">
                        {!!$errors->first("validity", "<span class='text-danger'>:message</span>")!!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                        {!!$errors->first("price", "<span class='text-danger'>:message</span>")!!}
                    </div>

                </div>
            </div>
            <div class="text-right">
                <div class="form-group">
                    <input type="submit" class="btn btn-bg" name="save" value="Save">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
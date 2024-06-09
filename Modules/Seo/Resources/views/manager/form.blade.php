@extends('admin.layouts.app')
@section('content')
<?php

use Modules\Seo\Entities\Seo;
?>
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="acive">Seo</li>
        <li class="mx-1">/</li>
        <li class="active">{{ isset($seo) ? 'Update' : 'Add' }}</li>
    </ul>
</div>
<div class="card">
    <div class="card-header">
        <div class="ProfileHader d-flex flex-wrap align-items-center">
            <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Add Manager</h3>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="{{url('/seo/manager/store')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ isset($seo) ? $seo->id : '' }}">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{ isset($seo) ? $seo->title : '' }}" required>
                        {!!$errors->first("name", "<span class='text-danger'>message</span>")!!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Route</label>
                        <input type="text" class="form-control" name="route" value="{{ isset($seo) ? $seo->route : '' }}" required>
                        {!!$errors->first("route", "<span class='text-danger'>message</span>")!!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Keyword</label>
                                <input type="text" class="form-control" name="keywords" value="{{ isset($seo) ? $seo->keywords : '' }}" required>
                                {!!$errors->first("keywords", "<span class='text-danger'>message</span>")!!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Data</label>
                                <input type="text" class="form-control" name="data" value="{{ isset($seo) ? $seo->data : '' }}" required>
                                {!!$errors->first("data", "<span class='text-danger'>message</span>")!!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option>Select</option>
                            <option value="0" {{ isset($seo) && $seo->state_id == Seo::STATE_NEW ? 'selected' : '' }}>New</option>
                            <option value="1" {{ isset($seo) && $seo->state_id == Seo::STATE_ACTIVE ? 'selected' : '' }}>Active</option>
                            <option value="2" {{ isset($seo) && $seo->state_id == Seo::STATE_DELETED ? 'selected' : '' }}>Deleted</option>
                        </select>
                        {!!$errors->first("status", "<span class='text-danger'>message</span>")!!}
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="6" required>{{ isset($seo) ? $seo->description : '' }}</textarea>
                        {!!$errors->first("description", "<span class='text-danger'>message</span>")!!}
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
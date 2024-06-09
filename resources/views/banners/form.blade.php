@extends('admin.layouts.app')
@section('content')
<h2>{{ isset($redirect) ? 'Update' : 'Add' }}</h2><br>
<div class="card p-5">
    <form method="post" action="{{url('/banners/store')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ isset($banner) ? $banner->id : '' }}">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>{{__('Title')}}</label>
                    <input type="text" class="form-control" name="title" value="{{ isset($banner) ? $banner->title : '' }}" required>
                    {!!$errors->first("title", "<span class='text-danger'>message</span>")!!}
                </div>

                <div class="form-group">
                    <label>{{__('Description')}}</label>
                    <input type="text" class="form-control" name="description" value="{{ isset($banner) ? $banner->description : '' }}" required>
                    {!!$errors->first("description", "<span class='text-danger'>message</span>")!!}
                </div>
                <div class="form-group">
                    <label>{{__('Banner File')}}:</label>
                    <input type="file" class="form-control" name="banner_file">
                    {!!$errors->first("banner_file", "<span class='text-danger'>message</span>")!!}
                </div>
                <div class="form-group">
                    <label>{{__('Status')}}</label>
                    <select name="type_id" class="form-control" required>
                        <option value="">Choose...</option>
                        @foreach($typeAttribute as $value => $name)
                        <option value="{{$value}}" {{ isset($banner) && $banner->type_id == $value ? 'selected' : ' '}}>{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-bg" name="submit" value="submit">
        </div>
    </form>
</div>

@endsection
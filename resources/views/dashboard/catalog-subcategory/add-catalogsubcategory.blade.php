@extends('admin.layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Add Subcategory</h2>
    </div>
    <div class="card-body">

        <form method="post" action="{{url('/catalog/subcategory/save')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Category:</label>
                <select class="form-control" name="category_id" id="category">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Title:</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                {!!$errors->first("title", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-bg" name="submit" value="submit">
            </div>
        </form>
    </div>
</div>
@endsection
@extends('admin.layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Add</h2>
    </div>
    <div class="card-body">

        <form method="post" action="{{url('/dashboard/transport-type/save')}}" enctype="multipart/form-data">
            @csrf
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
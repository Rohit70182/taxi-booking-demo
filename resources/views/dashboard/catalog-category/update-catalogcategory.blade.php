@extends('admin.layouts.app')
@section('content')
<div class="dash-home-cards">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="ProfileHader d-flex flex-wrap align-items-center">
                        <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Update</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{url('catalog/category/update/'.$GetData->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="title" value="{{$GetData->title}}">
                            {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-bg" name="submit" value="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('admin.layouts.app')
@section('content')

<div class="mb-1 mt-2">
  <ul class="breadcrumb">
    <li><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="mx-1">/</li>
    <li class="active">Update Profile</li>
  </ul>
</div>
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
          <form action="{{ url('dashboard/myprofile/update/'.$GetUser->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group mb-3">
                  <label for="">Name</label>
                  <input type="text" name="name" value="{{$GetUser->name}}" class="form-control">
                </div>

              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>profile file:</label>
                  <input type="file" class="form-control" name="image">
                </div>
              </div>
            </div>
            <div class="form-group mb-3 text-right">
              <button type="submit" class="btn btn-bg">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
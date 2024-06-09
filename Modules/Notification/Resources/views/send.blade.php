@extends('admin.layouts.app')
@section('content')
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">Manage</li>
        <li class="mx-1">/</li>
        <li class="active">Send Notifications</li>
    </ul>
</div>

<div class="card">
    <div class="card-body">

        <form method="post" action="{{url('/notifications/send')}}">
            @csrf
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title">
                        {!!$errors->first("title", "<span class='text-danger'>message</span>")!!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description">
                        {!!$errors->first("description", "<span class='text-danger'>message</span>")!!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Users</label>
                        <select name="user_id" class="form-control">
                            <option>Select</option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        {!!$errors->first("user_id", "<span class='text-danger'>message</span>")!!}
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <div class="form-group">
                        <input type="submit" class="btn btn-bg" name="submit" value="submit">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
@extends('admin.layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Add</h2>
    </div>
    <div class="card-body">

        <form method="post" action="{{url('/dashboard/driver/save')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Contact Number:</label>
                <input type="text" class="form-control" name="contact_no" value="{{ old('contact_no') }}">
                {!!$errors->first("contact_no", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Driver Type:</label>
                <select class="form-control" name="driver_type" id="driver_type">
                    <option value="">Select Driver Type</option>
                    <option value="1">Employee</option>
                    <option value="2">Freelancer</option>
                </select>
                {!!$errors->first("driver_type", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Assign Team:</label>
                <select class="form-control" name="team_id" id="team_id">
                    <option value="">Select Transport Type</option>
                    @foreach($teams as $team)
                    <option value="{{$team->id}}">{{$team->team_name}}</option>
                    @endforeach
                </select>
                {!!$errors->first("team_id", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Transport Type:</label>
                <select class="form-control" name="transport_type" id="transport_type">
                    <option value="">Select Transport Type</option>
                    @foreach($transport_type as $type)
                    <option value="{{$type->id}}">{{$type->title}}</option>
                    @endforeach
                </select>
                {!!$errors->first("transport_type", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Driver Tag:</label>
                <select class="form-control" name="driver_tag" id="driver_tag">
                    <option value="">Select Driver Tag</option>
                    @foreach($driver_tag as $tag)
                    <option value="{{$tag->id}}">{{$tag->title}}</option>
                    @endforeach
                </select>
                {!!$errors->first("driver_tag", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
            </div>

            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control" name="password">
                {!!$errors->first("password", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Profile Photo:</label>
                <input type="file" class="form-control" name="image">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-bg" name="submit" value="submit">
            </div>
        </form>
    </div>
</div>
@endsection
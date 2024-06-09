@extends('admin.layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Add</h2>
    </div>
    <div class="card-body">

        <form method="post" action="{{url('/dashboard/team/save')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Team Name:</label>
                <input type="text" class="form-control" name="team_name" value="{{ old('team_name') }}">
                {!!$errors->first("team_name", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Location:</label>
                <input type="text" class="form-control" name="location" value="{{ old('location') }}">
                {!!$errors->first("location", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Frequency:</label>
                <input type="text" class="form-control" name="frequency" value="{{ old('frequency') }}">
                {!!$errors->first("frequency", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Team Strength:</label>
                <input type="text" class="form-control" name="team_strength" value="{{ old('team_strength') }}">
                {!!$errors->first("team_strength", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Team Strength:</label>
                <select class="form-control" name="team_tag_id" id="team_tag_id">
                    <option value="">Select PromoCode</option>
                    @foreach($team_tags as $tag)
                    <option value="{{$tag->id}}">{{$tag->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-bg" name="submit" value="submit">
            </div>
        </form>
    </div>
</div>
@endsection
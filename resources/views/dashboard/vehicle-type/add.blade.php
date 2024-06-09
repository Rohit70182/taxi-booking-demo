@extends('admin.layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Add</h2>
    </div>
    <div class="card-body">

        <form method="post" action="{{url('/dashboard/vehicle-type/save')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Image:</label>
                <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                {!!$errors->first("image", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Vehicle Name:</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Cost Per Km:</label>
                <input type="text" class="form-control" name="cost_per_km" value="{{ old('cost_per_km') }}">
                {!!$errors->first("cost_per_km", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Cost Per Minute:</label>
                <input type="text" class="form-control" name="cost_per_minute" value="{{ old('cost_per_minute') }}">
                {!!$errors->first("cost_per_minute", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Max Seat Capacity:</label>
                <input type="text" class="form-control" name="max_seat_capacity" value="{{ old('max_seat_capacity') }}">
                {!!$errors->first("max_seat_capacity", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Base Price:</label>
                <input type="text" class="form-control" name="base_price" value="{{ old('base_price') }}">
                {!!$errors->first("base_price", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-bg" name="submit" value="submit">
            </div>
        </form>
    </div>
</div>
@endsection
@extends('admin.layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Add PromoCode</h2>
    </div>
    <div class="card-body">

        <form method="post" action="{{url('/dashboard/promo-code/save')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Code:</label>
                <input type="text" class="form-control" name="code" value="{{ old('code') }}">
                {!!$errors->first("code", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Description:</label>
                <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                {!!$errors->first("description", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Value:</label>
                <input type="text" class="form-control" name="value" value="{{ old('value') }}">
                {!!$errors->first("value", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Max Uses:</label>
                <input type="text" class="form-control" name="max_uses" value="{{ old('max_uses') }}">
                {!!$errors->first("max_uses", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Max Uses Per User:</label>
                <input type="text" class="form-control" name="max_uses_per_user" value="{{ old('max_uses_per_user') }}">
                {!!$errors->first("max_uses_per_user", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Start Date:</label>
                <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">
                {!!$errors->first("start_date", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Expiry Date:</label>
                <input type="date" class="form-control" name="expiry_date" value="{{ old('expiry_date') }}">
                {!!$errors->first("expiry_date", "<span class='text-danger'>:message</span>")!!}
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-bg" name="submit" value="submit">
            </div>
        </form>
    </div>
</div>
@endsection
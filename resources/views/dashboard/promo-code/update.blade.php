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
                    <form method="post" action="{{url('dashboard/promo-code/update/'.$GetData->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Code:</label>
                            <input type="text" class="form-control" name="code" value="{{ $GetData->code }}">
                            {!!$errors->first("code", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <input type="text" class="form-control" name="description" value="{{ $GetData->description }}">
                            {!!$errors->first("description", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        <div class="form-group">
                            <label>Value:</label>
                            <input type="text" class="form-control" name="value" value="{{ $GetData->value }}">
                            {!!$errors->first("value", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        <div class="form-group">
                            <label>Max Uses:</label>
                            <input type="text" class="form-control" name="max_uses" value="{{ $GetData->max_uses }}">
                            {!!$errors->first("max_uses", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        <div class="form-group">
                            <label>Max Uses Per User:</label>
                            <input type="text" class="form-control" name="max_uses_per_user" value="{{ $GetData->max_uses_per_user }}">
                            {!!$errors->first("max_uses_per_user", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        <div class="form-group">
                            <label>Start Date:</label>
                            <input type="date" class="form-control" name="start_date" value="{{ $GetData->start_date }}">
                            {!!$errors->first("start_date", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        <div class="form-group">
                            <label>Expiry Date:</label>
                            <input type="date" class="form-control" name="expiry_date" value="{{ $GetData->expiry_date }}">
                            {!!$errors->first("expiry_date", "<span class='text-danger'>:message</span>")!!}
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
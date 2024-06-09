@extends('admin.layouts.app')
@section('content')

<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">Sms</li>
        <li class="mx-1">/</li>
        <li class="active">Add</li>
    </ul>
</div>
<div class="card">
    <div class="card-body">
        <form method="post" action="{{url('/sms/send')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Number</label>
                        <input type="text" class="form-control" name="number" value="" required>
                        {!!$errors->first("number", "<span class='text-danger'>message</span>")!!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Message</label>
                        <input type="text" class="form-control" name="message" value="" required>
                        {!!$errors->first("message", "<span class='text-danger'>message</span>")!!}
                    </div>
                </div>
            </div>
            <div class="text-right">
                <div class="form-group">
                    <input type="submit" class="btn btn-bg" name="submit" value="submit">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
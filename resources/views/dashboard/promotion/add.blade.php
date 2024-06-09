@extends('admin.layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Add PromoCode</h2>
    </div>
    <div class="card-body">

        <form method="post" action="{{url('/dashboard/promotion/save')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Code:</label>
                <select class="form-control" name="code_id" id="code">
                    <option value="">Select PromoCode</option>
                    @foreach($promoCode as $code)
                    <option value="{{$code->id}}">{{$code->code}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Description:</label>
                <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                {!!$errors->first("description", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-bg" name="submit" value="submit">
            </div>
        </form>
    </div>
</div>
@endsection
@extends('admin.layouts.app')
@section('content')

    <h2>Plan</h2><br>
    <form method="post" action="{{url('/subscription/plan/update/'.$edit->id)}}">
        @csrf
        <div class="form-group">
            <label>title:</label>
            <input type="text" class="form-control" name="title" value="{{$edit->title}}"> 
            {!!$errors->first("title", "<span class='text-danger'>:message</span>")!!}
        </div>

        <div class="form-group">
          <label >Plan Type</label>
            <select name="type" class="form-control">
            <option value="{{$edit->type}}">{{$edit->getPlan()}}</option>
            <option></option>
          </select>
          {!!$errors->first("type", "<span class='text-danger'>:message</span>")!!}
        </div>
         <div class="form-group">
            <label>description</label>
           <input type="text" class="form-control" name="description" value="{{$edit->description}}">
            {!!$errors->first("description", "<span class='text-danger'>:message</span>")!!}
        </div>

        <div class="form-group">
            <label>Validity</label>
           <input type="text" class="form-control" name="validity" value="{{$edit->validity}}">
            {!!$errors->first("validity", "<span class='text-danger'>:message</span>")!!}
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="text" class="form-control" name="price" value="{{ old('price',$edit->price)}}"> 
            {!!$errors->first("price", "<span class='text-danger'>:message</span>")!!}
        </div>
        
        <div class="form-group">
            <input type="submit" class="btn btn-bg" name="save" value="Update">
        </div>
    </form>
@endsection
@extends('admin.layouts.app')
@section('content')
<div class="card">

    <div class="card-header">
        <h2>Add Variables</h2><br>
    </div>
    <div class="card-body">
        <form method="post" action="{{url('/settings/update/'.$edit->id)}}">
            @csrf
            <div class="form-group">
                <label>Module</label>
                <select name="module" class="form-control" required>
                    <option value="">Choose...</option>
                    @foreach($settingVariable as $value => $name)
                    <option value="{{$value}}" {{ isset($edit) && $edit->module == $value ? 'selected' : ' '}}>{{$name}}</option>
                    @endforeach
                </select>
                {!!$errors->first("module", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <label>Key</label>
                <input type="text" class="form-control" name="key" value="{{$edit->key}}">
                {!!$errors->first("key", "<span class='text-danger'>:message</span>")!!}
            </div>

            <div class="form-group">
                <label>value</label>
                <input type="text" class="form-control" value="{{$edit->value}}" name="value">
                {!!$errors->first("value", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-bg" name="save" value="Update">
            </div>
        </form>
    </div>
</div>
@endsection
@extends('admin.layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Add Vendor</h2>
    </div>
    <div class="card-body">
    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <div class="custom-file text-left">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <button class="btn btn-primary">Import Vendors</button>
        </form>
        
    </div>
</div>
@endsection
@extends('admin.layouts.app')
@section('content')
<div class="dash-home-cards">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="ProfileHader d-flex flex-wrap align-items-center">
                        <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Banners</h3>
                        <a class="btn btn-bg" href="{{url('/banners/create')}}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>

                </div>
                <div class="card-body table-responsive">
                    <table id="datatable" class="table table-bordered project
                    ">
                        <thead>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($banner as $banner)
                            <tr>
                                <td>{{$banner->id}}</td>
                                <td>{{$banner->title}}</td>
                                <td>{{$banner->description}}</td>
                                <td>{{$banner->state}}</td>
                                <td>{{$banner->type}}</td>
                                <td>
                                    <a href="{{url('/banners/delete')}}/{{$banner->id}}" onclick="return confirm('Are you sure?')" title="delete user" class="btn btn-bg" data-method="DELETE"><i class="fa fa-trash"></i></a>
                                    <a href="{{url('/banners/edit')}}/{{$banner->id}}" title="edit users" class="btn btn-bg" data-method="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="{{url('/banners/view')}}/{{$banner->id}}" title="view user" class="btn btn-bg" data-method="view"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Data Table CSS -->
<link rel="stylesheet" href="{{asset('public/dataTables/dataTables.min.css')}}">
@endpush
@push('scripts')
<!-- Data Table Script -->
<script src="{{asset('public/dataTables/dataTables.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endpush
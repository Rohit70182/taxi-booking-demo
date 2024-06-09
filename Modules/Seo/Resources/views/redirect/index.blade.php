@extends('admin.layouts.app')
@section('content')
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="acive">Seo</li>
        <li class="mx-1">/</li>
        <li class="active">Redirect</li>
    </ul>
</div>
<div class="dash-home-cards">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="ProfileHader d-flex flex-wrap align-items-center">
                        <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Redirect</h3>
                        <a class="btn btn-bg" href="{{url('/seo/redirect/add')}}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>

                </div>
                <div class="card-body table-responsive">
                    <table id="datatable" class="table table-bordered project
                    ">
                        <thead>
                            <th>Id</th>
                            <th>Old Url</th>
                            <th>New Url</th>
                            <th>Created By</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($redirect as $single)
                            <tr>
                                <td>{{$single->id}}</td>
                                <td>{{$single->old_url}}</td>
                                <td>{{$single->new_url}}</td>
                                <td>{{$single->get_created_by->name}}</td>
                                <td>{{$single->state}}</td>
                                <td>
                                    <a href="{{url('/seo/redirect/remove')}}/{{$single->id}}" onclick="return confirm('Are you sure?')" title="delete user" class="btn btn-bg" data-method="DELETE"><i class="fa fa-trash"></i></a>
                                    <a href="{{url('/seo/redirect/edit')}}/{{$single->id}}" title="edit users" class="btn btn-bg" data-method="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="{{url('/seo/redirect/view')}}/{{$single->id}}" title="view user" class="btn btn-bg" data-method="view"><i class="fa fa-eye"></i></a>
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
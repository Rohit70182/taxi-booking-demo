@extends('admin.layouts.app')
@section('content')
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="acive">Seo</li>
        <li class="mx-1">/</li>
        <li class="active">Analyst</li>
    </ul>
</div>
<div class="dash-home-cards">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="ProfileHader d-flex flex-wrap align-items-center">
                        <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Analyst</h3>
                        <a class="btn btn-bg" href="{{url('/seo/analytics/add')}}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>

                </div>
                <div class="card-body table-responsive">
                    <table id="datatable" class="table table-bordered project
                    ">
                        <thead>
                            <th>Id</th>
                            <th>Account</th>
                            <th>Domain Name</th>
                            <th>Analytics Type</th>
                            <th>Created By</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($analytics as $single)
                            <tr>
                                <td>{{$single->id}}</td>
                                <td>{{$single->account}}</td>
                                <td>{{$single->domain_name}}</td>
                                <td>{{$single->type}}</td>
                                <td>{{$single->get_created_by->name}}</td>
                                <td>{{$single->state}}</td>
                                <td> <a href="{{url('/seo/analytics/view')}}/{{$single->id}}" title="view user" class="btn-success btn" data-method="view"><i class="fa fa-eye"></i></a>
                                    <a href="{{url('/seo/analytics/edit')}}/{{$single->id}}" title="edit users" class="btn btn-bg" data-method="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="{{url('/seo/analytics/remove')}}/{{$single->id}}" onclick="return confirm('Are you sure?')" title="delete user" class="btn-danger btn" data-method="DELETE"><i class="fa fa-trash"></i></a>
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
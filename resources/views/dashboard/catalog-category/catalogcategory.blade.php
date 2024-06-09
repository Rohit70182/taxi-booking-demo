@extends('admin.layouts.app')

@section('content')

<div class="dash-home-cards">
    <div class="row">
        <div class="col-12">

            <div class="mb-1 mt-2">
                <ul class="breadcrumb">
                    <li><a href="{{url('/dashboard')}}">Home</a></li>
                    <li class="active">Manage</li>
                    <li class="active">Categories</li>
                </ul>
            </div>

            <div class="page-head-text">
                <div class="ProfileHader d-flex flex-wrap align-items-center">
                    <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Categories</h3>
                    <a class="btn btn-bg" href="{{ url('catalog/category/add')}}">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>

            <div class="page-index">
                Index
            </div>
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="datatable" class="table table-bordered project
                    ">
                        <thead>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($category as $cat)
                            <tr>
                                <td>{{$cat->id}}</td>
                                <td>{{$cat->title}}</td>
                                <td>
                                    <a href="{{url('/catalog/category/show/'.$cat->id)}}" title="view category" class="btn-success btn " data-method="view" data-trigger-confirm="1" data-pjax-target="#category-grid"><i class="fa fa-eye"></i></a>
                                    <a href="{{url('/catalog/category/edit/'.$cat->id)}}" title="edit category" class="btn btn-bg" data-method="Edit" data-trigger-confirm="1" data-pjax-target="#category-grid"><i class="fa fa-pencil"></i></a>
                                    <a href="{{url('/catalog/category/delete/'.$cat->id)}}" onclick="return confirm('Are you sure?')" title="delete category" class=" btn-danger btn" data-method="DELETE" data-trigger-confirm="1" data-pjax-target="#category-grid"><i class="fa fa-trash"></i></a>
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
        $('#datatable').DataTable({
            order: [
                [0, 'desc']
            ],
        });
    });
</script>
@endpush
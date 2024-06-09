@extends('admin.layouts.app')

@section('content')

<div class="dash-home-cards">
    <div class="row">
        <div class="col-12">

            <div class="mb-1 mt-2">
                <ul class="breadcrumb">
                    <li><a href="{{url('/dashboard')}}">Home</a></li>
                    <li class="active">Manage</li>
                    <li class="active">Sub Categories</li>
                </ul>
            </div>

            <div class="page-head-text">
                <div class="ProfileHader d-flex flex-wrap align-items-center">
                    <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Sub Categories</h3>
                    <a class="btn btn-bg" href="{{ url('catalog/subcategory/add')}}">
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
                            <th>Category</th>
                            <th>Title</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($sub_category as $sub)
                            <tr>
                                <td>{{$sub->id}}</td>
                                <td>{{$sub->category->title}}</td>
                                <td>{{$sub->title}}</td>
                                <td>
                                    <a href="{{url('/catalog/subcategory/show/'.$sub->id)}}" title="view sub-category" class="btn-success btn " data-method="view" data-trigger-confirm="1" data-pjax-target="#subcategory-grid"><i class="fa fa-eye"></i></a>
                                    <a href="{{url('catalog/subcategory/edit/'.$sub->id)}}" title="edit sub-category" class="btn btn-bg" data-method="Edit" data-trigger-confirm="1" data-pjax-target="#subcategory-grid"><i class="fa fa-pencil"></i></a>
                                    <a href="{{url('catalog/subcategory/delete/'.$sub->id)}}" onclick="return confirm('Are you sure?')" title="delete sub-category" class=" btn-danger btn" data-method="DELETE" data-trigger-confirm="1" data-pjax-target="#subcategory-grid"><i class="fa fa-trash"></i></a>
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
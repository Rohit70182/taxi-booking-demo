@extends('admin.layouts.app')
@section('content')

<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">Gateway</li>
    </ul>
</div>
<div class="dash-home-cards">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="ProfileHader d-flex flex-wrap align-items-center">
                        <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Gateways</h3>
                        <a class="btn btn-bg" href="{{url('/sms/gateway/add')}}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>

                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered projects">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Gateway Type</th>
                                <th>State</th>
                                <th>Created On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gateways as $getways)
                            <tr>
                                <td>{{$getways->id}}</td>
                                <td>{{$getways->title}}</td>
                                <td>{{$getways->getTypeAttribute()}}</td>
                                <td>{{$getways->getStateAttribute()}}</td>
                                <td>{{$getways->created_at}}</td>

                                <td> <a href="{{url('/sms/gateway/delete/'.$getways->id)}}" onclick="return confirm('Are you sure?')" title="delete" class="btn btn-bg" data-method="DELETE" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-trash"></i></a>
                                    <a href="{{url('/sms/gateway/edit/'.$getways->id)}}" title="edit" class="btn btn-bg" data-method="Edit" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-pencil"></i></a>
                                    <a href="{{url('/sms/gateway/show/'.$getways->id)}}" title="view" class="btn btn-bg" data-method="view" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-eye"></i></a>
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
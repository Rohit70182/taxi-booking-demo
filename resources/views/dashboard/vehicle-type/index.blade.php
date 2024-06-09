@extends('admin.layouts.app')

@section('content')

<div class="dash-home-cards">
    <div class="row">
        <div class="col-12">

            <div class="mb-1 mt-2">
                <ul class="breadcrumb">
                    <li><a href="{{url('/dashboard')}}">Home</a></li>
                    <li class="active">Manage</li>
                    <li class="active">Vehicle Types</li>
                </ul>
            </div>

            <div class="page-head-text">
                <div class="ProfileHader d-flex flex-wrap align-items-center">
                    <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Vehicle Types</h3>
                    <a class="btn btn-bg" href="{{ url('dashboard/vehicle-type/add')}}">
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
                            <th>Image</th>
                            <th>Vehicle Name</th>
                            <th>Cost Per Km</th>
                            <th>Cost Per Minute</th>
                            <th>Max Seat Capacity</th>
                            <th>Base Price</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($types as $type)
                            <tr>
                                <td>{{ $type->id }}</td>
                                <td> 
                                    @if('public/uploads/'.$type->image)
                                    <img src="{{url('public/uploads/'.$type->image)}}" width="40px" height="40px" style="border-radius:50%">
                                    @else
                                    <img src="{{ asset('public/images/ .png') }}" width="40px" height="40px" style="border-radius:50%">
                                    @endif
                                </td>
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->cost_per_km }}</td>
                                <td>{{ $type->cost_per_minute }}</td>
                                <td>{{ $type->max_seat_capacity }}</td>
                                <td>{{ $type->base_price }}</td>
                                <td>
                                    <a href="{{url('/dashboard/vehicle-type/show/'.$type->id)}}" title="view type" class="btn-success btn " data-method="view" data-trigger-confirm="1" data-pjax-target="#type-grid"><i class="fa fa-eye"></i></a>
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
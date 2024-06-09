@extends('admin.layouts.app')

@section('content')

<div class="dash-home-cards">
    <div class="row">
        <div class="col-12">

            <div class="mb-1 mt-2">
                <ul class="breadcrumb">
                    <li><a href="{{url('/dashboard')}}">Home</a></li>
                    <li class="active">Manage</li>
                    <li class="active">Orders</li>
                </ul>
            </div>
            
            <div class="page-head-text">
                <div class="ProfileHader d-flex flex-wrap align-items-center">
                    <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Orders</h3>
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
                            <th>Unique Id</th>
                            <th>Item name</th>
                            <th>Price</th>
                            <th>Created On</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->unique_id}}</td>
                                <td class="text-success">{{$order->item_id}}</td>
                                <td>{{$order->price}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                    <a href="{{url('/dashboard/orders/show/'.$order->id)}}" title="view user" class="btn-success btn " data-method="view" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-eye"></i></a>
                                    <a href="{{url('dashboard/orders/delete/'.$order->id)}}" onclick="return confirm('Are you sure?')" title="delete user" class=" btn-danger btn" data-method="DELETE" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-trash"></i></a>
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
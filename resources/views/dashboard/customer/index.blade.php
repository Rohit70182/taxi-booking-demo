@extends('admin.layouts.app')

@section('content')

<div class="dash-home-cards">
    <div class="row">
        <div class="col-12">
            <div class="mb-1 mt-2">
                <ul class="breadcrumb">
                    <li><a href="{{url('/dashboard')}}">Home</a></li>
                    <li class="active">Manage</li>
                    <li class="active">Customers</li>
                </ul>
            </div>

            <div class="page-head-text">
                <div class="ProfileHader d-flex flex-wrap align-items-center">
                    <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Customers</h3>
                    <a class="btn btn-bg" href="{{ url('dashboard/customer/add')}}">
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created On</th>
                            <th>Role</th>
                            <th>Profile file</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($customer as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td class="text-success">{{ $user->email }}</td>
                                <td><label class="label label-info">{{ $user->created_at }}</label></td>
                                <td>{{$user->getRole()}}</td>
                                <td>
                                    @if('public/uploads/'.$user->image)
                                    <img src="{{url('public/uploads/'.$user->image)}}" width="40px" height="40px" style="border-radius:50%">
                                    @else
                                    <img src="{{ asset('public/images/ .png') }}" width="40px" height="40px" style="border-radius:50%">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('/dashboard/customer/show/'.$user->id)}}" title="view user" class="btn-success btn " data-method="view" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-eye"></i></a>
                                    <a type="submit" id="delete" title="delete customer" class=" btn-danger btn" data-pjax-target="#user-grid"><i class="fa fa-trash"></i>
                                    </a>
                                    <form class="deleteRecord" id="delete-form-{{$user->id}}" + action="{{route('customer.delete', $user->id)}}" method="post">
                                        @csrf @method('DELETE')
                                    </form>
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

        $("#delete").click(function() {
            if (confirm('Are you sure?'))
                $('.deleteRecord').submit();

        });
    });
</script>
@endpush
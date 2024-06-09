@extends('admin.layouts.app')

@section('content')

<div class="dash-home-cards">
    <div class="row">
        <div class="col-12">

            <div class="mb-1 mt-2">
                <ul class="breadcrumb">
                    <li><a href="{{url('/dashboard')}}">Home</a></li>
                    <li class="active">Manage</li>
                    <li class="active">Drivers</li>
                </ul>
            </div>
            <div class="page-head-text">
                <div class="ProfileHader d-flex flex-wrap align-items-center">
                    <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Drivers</h3>
                    <a class="btn btn-bg" href="{{ url('dashboard/driver/add')}}">
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
                            <th>Contact</th>
                            <th>Driver Type</th>
                            <th>Assign Team</th>
                            <th>Transport Type</th>
                            <th>Driver Tag</th>
                            <th>Created On</th>
                            <th>Role</th>
                            <th>Profile file</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($driver as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td class="text-success">{{ $user->email }}</td>
                                <td>{{ $user->contact_no }}</td>
                                <td>{{ $user->getDriverTypeName() }}</td>
                                <td>{{ $user->getTeamName() }}</td>
                                <td>{{ $user->getTransportTypeName() }}</td>
                                <td>{{ $user->getDriverTagName() }}</td>
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
                                    <a  href="{{url('/dashboard/driver/show/'.$user->id)}}" title="view driver" class="btn-success btn " data-method="view" data-trigger-confirm="1" data-pjax-target="#driver-grid"><i class="fa fa-eye"></i></a>
                                    <a data-id="{{$user->id}}" type = "submit" id="delete"  title="driver" class=" btn-danger btn"  data-pjax-target="#tag-driver"><i class="fa fa-trash"></i>
                                    </a>
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

            $(document).on("click", "#delete", function() { 
            if (confirm('Are you sure?'))
                var id = $(this).data("id");
                $.ajax(
                {
                  url: "driver/delete/"+id,
                  type: 'delete',
                  data: {
                    "id": id,
                    "_method": 'delete',
                    '_token': $('meta[name=csrf-token]').attr("content"),
                  },
                  done: function (){
                    window.location.reload();
                  },
                  fail: function(){
                    console.log("ERROR!");
                  } 
                });

        });
    });
</script>
@endpush
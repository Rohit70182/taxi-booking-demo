@extends('admin.layouts.app')

@section('content')

<div class="dash-home-cards">
    <div class="row">
        <div class="col-12">

            <div class="mb-1 mt-2">
                <ul class="breadcrumb">
                    <li><a href="{{url('/dashboard')}}">Home</a></li>
                    <li class="mx-1">/</li>
                    <li class="active">Manage</li>
                    <li class="mx-1">/</li>
                    <li class="active">Email</li>
                </ul>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="page-head-text">
                        <div class="ProfileHader d-flex flex-wrap align-items-center">
                            <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Email Queue</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="datatable" class="table table-bordered project
                    ">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>From Email</th>
                                <th>To Email</th>
                                <th>Message</th>
                                <th width="20px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($emailQueue as $emails)
                            <tr>
                                <td>{{$emails->id}}</td>
                                <td>{{$emails->from_email}}</td>
                                <td>{{$emails->to_email}}</td>
                                <td>{{$emails->message}}</td>
                                <td><a href="{{url('/emailQueue/view/'.$emails->id)}}" title="view" class="btn-success btn " data-method="View" data-pjax-target="#user-grid"><i class="fa fa-eye"></i></a>
                                    <a href="{{url('/emailQueue/delete/'.$emails->id)}}}" title="delete" onclick="return confirm('Are you sure to delete this log ?')" class="btn-danger btn"><i class="fa fa-trash"></i></a>
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
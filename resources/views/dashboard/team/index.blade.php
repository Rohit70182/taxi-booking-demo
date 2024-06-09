@extends('admin.layouts.app')

@section('content')

<div class="dash-home-cards">
    <div class="row">
        <div class="col-12">

            <div class="mb-1 mt-2">
                <ul class="breadcrumb">
                    <li><a href="{{url('/dashboard')}}">Home</a></li>
                    <li class="active">Manage</li>
                    <li class="active">Teams</li>
                </ul>
            </div>

            <div class="page-head-text">
                <div class="ProfileHader d-flex flex-wrap align-items-center">
                    <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Teams</h3>
                    <a class="btn btn-bg" href="{{ url('dashboard/team/add')}}">
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
                            <th>Team Name</th>
                            <th>Location</th>
                            <th>Frequency</th>
                            <th>Team Strength</th>
                            <th>Team Tag</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($teams as $team)
                            <tr>
                                <td>{{ $team->id }}</td>
                                <td>{{ $team->team_name }}</td>
                                <td>{{ $team->location }}</td>
                                <td>{{ $team->frequency }}</td>
                                <td>{{ $team->team_strength }}</td>
                                <td>{{ $team->getTeamTagName() }}</td>

                                <td>
                                    <a href="{{url('/dashboard/team/show/'.$team->id)}}" title="view team" class="btn-success btn " data-method="view" data-trigger-confirm="1" data-pjax-target="#team-grid"><i class="fa fa-eye"></i></a>
                                    <a type = "submit" id="delete"  title="delete team" class=" btn-danger btn"  data-pjax-target="#team-grid"><i class="fa fa-trash"></i>
                                    </a>
                                    <form class="deleteRecord" id="delete-form-{{$team->id}}" 
                                    + action="{{route('team.delete', $team->id)}}"
                                    method="post">
                                    @csrf @method('DELETE')
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
        $("#delete").click(function(){
            if(confirm('Are you sure?'))
            $('.deleteRecord').submit();

        });
    });
</script>
@endpush
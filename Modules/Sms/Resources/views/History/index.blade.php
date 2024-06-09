@extends('admin.layouts.app')
@section('content')
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">Histories</li>
    </ul>
</div>
<div class="dash-home-cards">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="ProfileHader d-flex flex-wrap align-items-center">
                        <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Histories</h3>
                        
                           
                        </a>
                    </div>

                </div>
                <div class="card-body">
                     <a id="bulk_delete_history-grid" class="multiple-delete glyphicon glyphicon-trash" href="#"></a>
                    <table id="datatable" class="table table-bordered projects">
                        <thead>
                        <tr>
                                   <th>Id</th>

                                   <th>From</th>
                                   <th>To</th>
                                   <th>Text</th>
                                   <th>Gateway</th>
                                   	<th>State</th>
                                   <th>Title</th>
                                   <th>Gateway Type</th>
                                   <th>State</th>

                                   <th>Created On</th>
                                   <th>Created By</th>
                                   <th >Actions</th>
                        
                        </tr>          
 
                        </thead>
                        <tbody>
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
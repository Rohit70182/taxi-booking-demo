@extends('admin.layouts.app')

@section('content')

<div class="dash-home-cards">
    <div class="row">
        <div class="col-12">

            <div class="mb-1 mt-2">
                <ul class="breadcrumb">
                    <li><a href="{{url('/dashboard')}}">Home</a></li>
                    <li class="active">Manage</li>
                    <li class="active">Promocodes</li>
                </ul>
            </div>

            <div class="page-head-text">
                <div class="ProfileHader d-flex flex-wrap align-items-center">
                    <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Promocodes</h3>
                    <a class="btn btn-bg" href="{{ url('dashboard/promo-code/add')}}">
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
                            <th>Code</th>
                            <th>Description</th>
                            <th>Value</th>
                            <th>Max Uses</th>
                            <th>Max Uses Per User</th>
                            <th>Start Date</th>
                            <th>Expiry Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($promoCode as $code)
                            <tr>
                                <td>{{$code->id}}</td>
                                <td>{{$code->code}}</td>
                                <td>{{$code->description}}</td>
                                <td>{{$code->value}}</td>
                                <td>{{$code->max_uses}}</td>
                                <td>{{$code->max_uses_per_user}}</td>
                                <td>{{$code->start_date}}</td>
                                <td>{{$code->expiry_date}}</td>
                                <td>
                                    <a href="{{url('/dashboard/promo-code/show/'.$code->id)}}" title="view promocode" class="btn-success btn " data-method="view" data-trigger-confirm="1" data-pjax-target="#promocode-grid"><i class="fa fa-eye"></i></a>
                                    <a href="{{url('dashboard/promo-code/edit/'.$code->id)}}" title="edit promocode" class="btn btn-bg" data-method="Edit" data-trigger-confirm="1" data-pjax-target="#promocode-grid"><i class="fa fa-pencil"></i></a>
                                    <a type = "submit" id="delete"  title="delete promocode" class=" btn-danger btn"  data-pjax-target="#promocode-grid"><i class="fa fa-trash"></i>
                                    </a>
                                    <form class="deleteRecord" id="delete-form-{{$code->id}}" 
                                    + action="{{route('promo.delete', $code->id)}}"
                                    method="post">
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
        $("#delete").click(function(){
            if(confirm('Are you sure?'))
            $('.deleteRecord').submit();

        });
    });
</script>
@endpush
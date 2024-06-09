@extends('admin.layouts.app')
@section('content')
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">Plans</li>
    </ul>
</div>
<div class="dash-home-cards">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="ProfileHader d-flex flex-wrap align-items-center">
            <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Plans</h3>
            <a class="btn btn-bg" href="{{ url('/subscription/plan/add') }}">
              <i class="fa fa-plus"></i>
            </a>
          </div>

        </div>
        <div class="card-body table-responsive">
          <table id="ThemeTable" class="table table-bordered projects">
            <thead>
              <th>Id</th>
              <th>title</th>
              <th>Validity</th>
              <th>Price</th>
              <th>Plan type</th>
              <th>Action</th>
            </thead>
            <tbody>
              @foreach($plans as $plan)
              <tr>
                <td>{{$plan->id}}</td>
                <td>{{$plan->title}}</td>
                <td>{{$plan->validity}}</td>
                <td>{{$plan->price}}</td>
                <td>{{$plan->getPlan()}}</td>
                <td> 
                  <a href="{{url('/subscription/plan/show/'.$plan->id)}}" title="view post" class="btn-success btn " data-method="view" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-eye"></i></a>
                <a href="{{url('/subscription/plan/edit/'.$plan->id)}}" title="edit post" class="btn btn-bg" data-method="Edit" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-pencil"></i></a>
                <a href="{{url('/subscription/plan/delete/'.$plan->id)}}" onclick="return confirm('Are you sure?')" title="delete post" class=" btn-danger btn" data-method="DELETE" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-trash"></i></a>
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
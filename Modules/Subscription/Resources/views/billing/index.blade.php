@extends('admin.layouts.app')
@section('content')
<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">Billings</li>
    </ul>
</div>
<div class="dash-home-cards">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="ProfileHader d-flex flex-wrap align-items-center">
            <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Billings</h3>
            </a>
          </div>

        </div>
        <div class="card-body table-responsive">
          <table id="ThemeTable" class="table table-bordered projects">
            <thead>
              <th>Id</th>
              <th>Subscription Id</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Type Id</th>
              <th>Action</th>
            </thead>
            </tbody>
            @foreach($billing as $billings)
            <tr>
              <td>{{$billings->id}}</td>
              <td>{{$billings->subscription_id}}</td>
              <td>{{$billings->start_date}}</td>
              <td>{{$billings->end_date}}</td>
              <td>{{$billings->type_id}}</td>
              <td> <a href="{{url('/subscription/billing/delete/'.$billings->id)}}" onclick="return confirm('Are you sure?')" title="delete post" class=" btn-danger btn" data-method="DELETE" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-trash"></i></a>
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
@extends('admin.layouts.app')
@section('content')
<div class="mb-1 mt-2">
  <ul class="breadcrumb">
    <li><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="mx-1">/</li>
    <li class="active">Manage</li>
    <li class="mx-1">/</li>
    <li class="active">Settings</li>
  </ul>
</div>
<div class="dash-home-cards">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="ProfileHader d-flex flex-wrap align-items-center">
            <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Settings</h3>
            <a class="btn btn-bg" href="{{ url('/settings/add') }}">
              <i class="fa fa-plus"></i>
            </a>
          </div>

        </div>
        <div class="card-body table-responsive">
          <table id="ThemeTable" class="table table-bordered projects">
            <thead>
              <th>Id</th>
              <th>Module</th>
              <th>Key</th>
              <th>Value</th>
              <th>Created By</th>
              <th>Action</th>
            </thead>
            <tbody>
              @foreach($settings as $setting)
              <tr>
                <td>{{$setting->id}}</td>
                <td>{{$setting->getModule()}}</td>
                <td>{{$setting->key}}</td>
                <td>{{$setting->value}}</td>
                <td>{{$setting->getUser->name}}</td>
                <td>
                  <a href="{{url('settings/show/'.$setting->id)}}" title="view Settings" class="btn-success btn " data-method="view" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-eye"></i></a>
                  <a href="{{url('/settings/edit/'.$setting->id)}}" title="edit Settings" class="btn btn-bg" data-method="Edit" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-pencil"></i></a>
                  <a href="{{url('/settings/delete/'.$setting->id)}}" onclick="return confirm('Are you sure?')" title="delete setting" class=" btn-danger btn" data-method="DELETE" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-trash"></i></a>
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
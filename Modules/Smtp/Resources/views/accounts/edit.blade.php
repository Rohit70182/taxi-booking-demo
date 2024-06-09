@extends('admin.layouts.app')
@section('content')
<div class="dash-home-cards">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="ProfileHader d-flex flex-wrap align-items-center">
            <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Accounts</h3>
            </div>
            <div class="card-body">
              <form method="post" action="{{url('smtp/update/'.$account->id)}}">
              	@csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ $account->title}}"class="form-control">
                    {!!$errors->first("title", "<span class='text-danger'>:message</span>")!!}
                  </div>
                  <div class="form-group col-md-6">
                    <label>Encryption Type</label>
                    <select name="encryption_type" class="form-control">
                      <option value="">Choose...</option>
                      @foreach($encryption as $value=>$name)
                     <option value="{{$value}}" {{ isset($account) && $account->encryption_type == $value ? 'selected' : '' }}>{{$name}}</option>
                     @endforeach
                   </select>
                    {!!$errors->first("Encryption_type", "<span class='text-danger'>:message</span>")!!}
                  </div>
                </div>
                <div class="form-row">
                <div class="form-group col-md-9">
                  <label>Email</label>
                  <input type="text" name="email" value="{{ $account->email }}"class="form-control" >
                   {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
                </div>
                
              </div>
               <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Server	</label>
                  <input type="text" value="{{ $account->server }}" name="server" class="form-control" >
                   {!!$errors->first("server", "<span class='text-danger'>:message</span>")!!}
                </div>
                <div class="form-group col-md-6">
                  <label>Port</label>
                  <input type="text" value="{{ $account->port }}" name="port" class="form-control" >
                </div>
              </div>
                
                <input type="submit" class="btn btn-bg" name="update" value="update">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
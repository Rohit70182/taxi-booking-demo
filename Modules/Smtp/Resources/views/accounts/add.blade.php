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
              <form method="post" action="{{url('smtp/store/')}}">
              	@csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ old('title') }}"class="form-control">
                    {!!$errors->first("title", "<span class='text-danger'>:message</span>")!!}
                  </div>
                  <div class="form-group col-md-6">
                    <label>Encryption Type</label>
                    <select name="encryption_type" class="form-control">
                     <option value="">Choose encryption</option>
                     <option value="0">None</option>
                     <option value="1">TLS</option>
                     <option value="2">SSL</option>
                   </select>
                    {!!$errors->first("Encryption_type", "<span class='text-danger'>:message</span>")!!}
                  </div>
                </div>

                <div class="form-row">
                <div class="form-group col-md-9">
                  <label>Email</label>
                  <input type="text" name="email" value="{{ old('email') }}"class="form-control" >
                   {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
                </div>
                
              </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Password	</label>
                  <input type="text" value="{{ old('password') }}" name="password" class="form-control" >
                   {!!$errors->first("password", "<span class='text-danger'>:message</span>")!!}
                </div>
                <div class="form-group col-md-6">
                  <label>Type</label>
                  <select name="type" class="form-control">
                     <option value="">Choose type</option>
                     <option value="0">SMTP</option>
                   </select>
                </div>
              </div>
               <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Server	</label>
                  <input type="text" value="{{ old('server') }}" name="server" class="form-control" >
                   {!!$errors->first("server", "<span class='text-danger'>:message</span>")!!}
                </div>
                <div class="form-group col-md-6">
                  <label>Port</label>
                  <input type="text" value="{{ old('port') }}" name="port" class="form-control" >
                   {!!$errors->first("post", "<span class='text-danger'>:message</span>")!!}
                </div>
              </div>
                
                <input type="submit" class="btn btn-bg" name="Save" value="save">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
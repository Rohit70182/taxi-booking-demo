@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('public/assets/css/pages-css/autn.css') }}" />
<!-- Style Css -->

<div>

  <section class="autn-form sec-ptb">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-6 col-lg-6">
          <div class="user-form-card">
            <div class="user-form-title">
              <h2 class="text-center">Register</h2>
            </div>
            <form method="post" action="{{url('/register')}}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="form-group col-md-12">
                  <label>Name</label>
                  <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                  {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
                </div>

                <!-- <div class="form-group col-md-12">
                  <label>Role</label>
                  <select name="role" class="form-control">
                    <option>Choose your role</option>
                    <option value="0">Admin</option>
                    <option value="1">User</option>
                  </select>
                  {!!$errors->first("role", "<span class='text-danger'>:message</span>")!!}
                </div> -->

                <div class="form-group col-md-12">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                  {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
                </div>

                <div class="form-group col-md-12">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password">
                  {!!$errors->first("password", "<span class='text-danger'>:message</span>")!!}
                </div>
                <div class="form-group col-lg-12">
                  <label>Profile Photo</label>
                  <input type="file" class="form-control" name="image">
                </div>


                <button type="submit" class="secondary-btn btn btn-bg  btn-lg w-100 my-4">
                  {{ __('Submit') }}
                </button>
              </div>
            </form>
            <div class="user-form-remind text-center mt-0">
              <p class="mb-0">Already have a account? <a href="{{url('/login')}}">Log In </a> here</p>
            </div>
            @endsection


          </div>
        </div>
      </div>
    </div>
  </section>
</div>
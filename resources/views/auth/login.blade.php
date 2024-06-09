@extends('layouts.app')

@section('content')
<!-- Style Css -->
<link rel="stylesheet" href="{{ asset('public/assets/css/pages-css/autn.css') }}" />
<!-- Style Css -->


<section class="autn-form sec-ptb">
  <div class="container">
    <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-6 col-lg-6">
        <div class="user-form-card">
          <div class="user-form-title">
            <h2 class="text-center">Log In</h2>
          </div>
          <form method="POST" action="{{url('/sign-in')}}">
            @csrf
            @if(session('message'))
            <h6 class="alert alert-success">
              {{ session('message') }}
            </h6>
            @endif
            <div class="form-group">
              <label for="email">Email</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="password">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">
                <div class="eye-icons"><i class="fas fa-eye-slash" id="show_password" onclick="showPassword('password')"></i><i class="fas fa-eye" id="hide_password" onclick="hidePassword('password')" style="display:none"></i></div>
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" name="remember_me" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                Remember me
              </label>
            </div>
            @if($errors->any())
            <div class="invalid-feedback">{{ $errors->first() }}</div>
            @endif
            <div class="row form-group">
              <div class="col-sm-6 text-sm-right mt-sm-0 mt-10">
                @if (Route::has('password.request'))
                <a class="" href="{{ route('password.request') }}">
                  {{ __('Forgot Your Password?') }}
                </a>
                @endif
              </div>
            </div>
            <div class="form-button">
              <button type="submit" class="secondary-btn btn btn-bg  btn-lg w-100">
                {{ __('Login') }}
              </button>
            </div>
          </form>
          <div class="user-form-remind text-center mt-4">
            <p class="mb-0">Don't have any account? <a href="{{url('/register')}}">SignUp </a> here</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
  function showPassword(id) {
    $("#" + id).attr('type', 'text');
    $("#hide_" + id).show();
    $("#show_" + id).hide();
  }

  function hidePassword(id) {
    $("#" + id).attr('type', 'password');
    $("#hide_" + id).hide();
    $("#show_" + id).show();
  }
</script>
@endsection
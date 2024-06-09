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
              <h2 class="text-center">{{__('Reset Password')}}</h2>
            </div>
            <form method="post" action="{{url('/user/recover')}}" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                  <label for="email">Email/contact</label>
                  <input id="email" type="email_or_phone" class="form-control @error('email_or_phone') is-invalid @enderror" name="email_or_phone" value="{{ old('email_or_phone') }}" autofocus>
                  @error('email_or_phone')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <button type="submit" class="secondary-btn btn btn-bg  btn-lg w-100 my-4">
                  {{ __('Submit') }}
                </button>
            </form>
            @endsection


          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@extends('layouts.app')

@section('content')

<div id="contact">

  <section class="terms-wrap innerbanner-bg ">
    <div class="banner-inner">
      <h2 class="main-title text-white">Contact Us</h2>
    </div>
  </section>

  <section class="contact-from-area content-wrap">

    <div class="container">

      <div class="row justify-content-center">

        <div class="col-lg-8 col-12">
          <div class="contact-right">
            <div class="contact-form fix">

              <form id="contact-form" action="mail.php" method="post">
                <div class="row">
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                  </div>
                  <div class="form-group col-lg-6 col-md-12">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                  </div>
                  <div class="form-group col-lg-12">
                    <label for="subject">Subject</label>
                    <input type="text" name="text" id="sub" class="form-control" placeholder="Subject">
                  </div>
                  <div class="form-group col-lg-12">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="6" placeholder="Message" class="form-control"></textarea>
                  </div>
                  <div class="form-group col-lg-12 text-center">
                    <button type="submit" class="secondary-btn btn btn-bg submit-btn w-25 d-block mx-auto mt-4">SUBMIT</button>
                  </div>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

</div>

@endsection
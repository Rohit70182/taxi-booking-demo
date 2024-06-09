<?php include 'header.php';?>

<!-- Style Css -->
<link rel="stylesheet" href="./assets/css/pages-css/registration.css" />


<section class="breadcrumb-area" style="background-image: url(./assets/images/banner/banner-4.jpg);">
  <div class="overlay-bg"></div>
  <div class="container">
    <div class="breadcrumb-inner text-center">
      <h1 class="page-title">Signup</h1>
    </div>
  </div>
</section>
<section class="login-area">
  <div class="container">
    <div class="account-login-inner">
      <h3 class="item-title text-center">Sign Into <span>Your Account</span></h3>
      <form action="#" class="form-box contact-form-box">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="First Name">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Last Name">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Your Email">
        </div>
        <div class="position-relative">
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password*">
          </div>
          <span class="far toggle-password fa-eye-slash"></span>
        </div>
        <div class="form-group">
          <div class="login-page-checkbox">
            <div class="form-check">
              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" id="validationFormCheck2" class="form-check-input" name="LoginForm[rememberMe]"
                    value="1">
                  <label class="custom-control-label" for="validationFormCheck2">I agree to the <a href="#"
                      target="_blank" rel="noopener noreferrer">Terms of use</a> and <a href="" target="_blank"
                      rel="noopener noreferrer">Privacy policy</a></label>

                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="btn-wrapper form-group">
          <button class="btn-theme btn btn-effect-1 btn-lg w-100" tabindex="0">Next</button>
        </div>

      </form>
    </div>

  </div>
</section>

<script>
  $(".toggle-password").click(function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var type = $(this).hasClass("fa-eye") ? "text" : "password";
    $(this).closest('div').find(".form-control").attr("type", type);
  });
</script>
<?php include 'footer.php';?>
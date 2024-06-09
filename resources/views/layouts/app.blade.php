<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>{{get_seo() ? get_seo()->title : config('app.name')}}</title>
  <!-- Metas -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="description" content="{{get_seo() ? get_seo()->description : 'project Description'}}">
  <meta name="keywords" content="{{get_seo() ? get_seo()->keywords : 'project keywords'}}">
  <meta name="author" content="@ozvidtech">
  <!-- Title  -->
  <link rel="shortcut icon" href="{{ asset('public/assets/images/fav.ico') }}" />
  <!-- Bootstrap Css -->
  <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
  <!-- Plugins -->
  <link rel="stylesheet" href="{{ asset('public/assets/css/helpers-plugin.css') }}" />
  <!-- Style Css -->
  <link rel="stylesheet" href="{{ asset('public/assets/css/theme-style.css') }}" />
  <!-- fontawesome Css -->
  <link rel="stylesheet" href="{{ asset('public/assets/fonts/fontawesome/css/all.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('public/assets/toastr.min.css') }}" />
  <script src="{{ asset('public/assets/js/jquery.slim.min.js') }}"></script>
  <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Animation -->
  <link rel="stylesheet" href="{{ asset('public/assets/plugins/animation/animate.min.css') }}" />
  <script src="{{ asset('public/assets/plugins/animation/wow.min.js') }}"></script>
</head>

<body class="">
  @include('layouts.header')
  <!-- Start Page Wrapper -->
  <main class="page-wrapper">
    @yield('content')
  </main>
  <!-- Footer -->
  @include('layouts.footer')
  <!-- Footer -->
  <div class="copyright-area">
    <div class="container">
      <div class="copyright-menu text-center">
        <ul>
          <li>
            <p>© All Rights Reserved {{config('app.name')}}</p>
          </li>
          <li>|</li>
          <li><a href="{{url('/terms')}}">Terms &amp; Conditions</a></li>
          <li>|</li>
          <li><a href="{{url('/privacy')}}">Privacy &amp; Policy</a></li>
        </ul>
      </div>
    </div>
  </div>
  <!-- common -->
  <script src="{{ asset('public/assets/plugins/animation/wow.min.js') }}"></script>
  <script src="{{ asset('public/js/jquery.js') }}"></script>
  <script src="{{ asset('public/assets/js/common.js') }}"></script>
  <script src="{{ asset('public/assets/toastr.min.js') }}"></script>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-{{get_analytics() ? get_analytics()->account : ''}}"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-{{get_analytics() ? get_analytics()->account : ""}}');
  </script>

  @if (session('success'))
  <script>
    toastr.success(' ', "{{ session('success') }}")
  </script>
  @endif
  @if (session('error'))
  <script>
    toastr.error(' ', "{{ session('error') }}")
  </script>
  @endif
</body>

</html>
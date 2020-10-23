<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Will Be Added Automatically By SEOTools --}}
    <title> {{ config('app.name') }}</title>
    {{-- MINIFIED ? add true in generate method --}}
    {!! SEO::generate(true) !!}
   <!-- Favicon And PWA -->

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/assets/img/logo/apple-touch-icon.png') }} ">
    <link rel="icon" type="image/png') }} " sizes="32x32" href="{{ asset('/assets/img/logo/favicon-32x32.png') }} ">
    <link rel="icon" type="image/png') }} " sizes="16x16" href="{{ asset('/assets/img/logo/favicon-16x16.png') }} ">
    <link rel="manifest" href="{{ asset('/assets/img/logo/site.webmanifest') }} ">
    <link rel="mask-icon" href=href="{{ asset('/assets/img/logo/safari-pinned-tab.svg') }} " color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="msapplication-TileImage" content=href="{{ asset('/assets/img/logo/mstile-144x144.png') }} ">
    <meta name="theme-color" content="#ffffff">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
   <!-- Vendor CSS Files -->
  <link href="{{ asset('/assets/vendor/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet">
  <link href="{{ asset('/assets/vendor/font-awesome/css/font-awesome.min.css') }} " rel="stylesheet">
  <link href="{{ asset('/assets/vendor/ionicons/css/ionicons.min.css') }} " rel="stylesheet">
  <link href="{{ asset('/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }} " rel="stylesheet">
  <link href="{{ asset('/assets/vendor/venobox/venobox.css') }} " rel="stylesheet">
  <link href="{{ asset('/assets/vendor/aos/aos.css') }} " rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('/assets/css/style.css') }} " rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/login.style.css') }}">
   
    @yield('styles')

</head>
<body>
 
    <div id="app">
      @include('layouts.includes._header')
          @yield('content')

         @include('layouts.includes._footer')
    
        </div>

    {{-- Sweet Alert --}}
    @include('sweetalert::alert')
    
    <!-- Scripts -->
    {{-- <script src="{{ mix('/assets/dist/js/vendors.js') }}"></script> --}}
    {{-- <script src="{{ asset('/assets/js/'. getDirection() .'/'. getDirection() .'.js') }}"></script> --}}

        <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>



    @yield('scripts')

</body>
</html>

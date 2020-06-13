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
    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="76x76" href="{{ getSettings()->mainMediaUrl('intro_image') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ getSettings()->mainMediaUrl('intro_image') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ getSettings()->mainMediaUrl('intro_image') }}">
    {{-- <link href="https://fonts.googleapis.com/css?family=Lato:400,600,700" rel="stylesheet" /> --}}
    {{-- <link rel="manifest" href="{{ asset('/assets/dist/favicon/site.webmanifest') }}"> --}}
    {{-- <link rel="mask-icon" href="{{ asset('/assets/dist/favicon/safari-pinned-tab.svg') }}" color="#FF4D4D"> --}}
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/assets/dist/lib/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/dist/css/'. getDirection() .'/'. getDirection() .'.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/dist/media/'. getDirection() .'/'. getDirection() .'.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('/assets/dist/css/custom.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/dist/css/util.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/dist/css/login.style.css') }}">
   
    @yield('styles')

</head>
<body>
    <div id="app">
      
        @yield('content')

        {{-- @include('layouts.includes._footer') --}}
     </div>

    {{-- Sweet Alert --}}
    @include('sweetalert::alert')
    
    <!-- Scripts -->
    {{-- <script src="{{ mix('/assets/dist/js/vendors.js') }}"></script> --}}
    <script src="{{ asset('/assets/dist/js/'. getDirection() .'/'. getDirection() .'.js') }}"></script>

    @yield('scripts')

</body>
</html>

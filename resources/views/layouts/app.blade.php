<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{!! asset('public/favicon.ico') !!}">

    <title>@yield('title')</title>

    <meta name="description" content="Start your development with a Design System for Bootstrap 4.">
    <meta name="author" content="Creative Tim">

    <link type="text/css" href="{{asset('css/animate.css')}}" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link type="text/css" href="{{asset('vendor/nucleo/css/nucleo.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Argon CSS -->
    <link type="text/css" href="{{asset('css/argon.css')}}" rel="stylesheet">

    <link type="text/css" href="{{asset('flag-icon-css-master/css/flag-icon.min.css')}}" rel="stylesheet">

    @yield('page_css')
</head>
<body>
@include('layouts.topnavbar')
<main>
    <div class="position-relative">
        @yield('content')
    </div>
</main>
@include('layouts.footer')
</body>

    <script src="{!! asset('js/jquery-3.3.1.min.js') !!}"></script>

    <script src="{!! asset('vendor/popper/popper.min.js') !!}"></script>
    <script src="{!! asset('vendor/bootstrap/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('vendor/headroom/headroom.min.js') !!}"></script>
    <!-- Argon JS -->
    <script src="{!! asset('js/argon.js') !!}?v=1.0.1"></script>

    @yield('page_scripts')


</html>

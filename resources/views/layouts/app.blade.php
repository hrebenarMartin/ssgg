<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{!! asset('css/app.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/w3.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/color_scheme.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/style.css') !!}" rel="stylesheet">

    @yield('page_css')
</head>
<body>
    <div id="app">

        @include('layouts.topnavbar')

        <main class="py-4" id="main-content">
            @yield('content')
        </main>

        @include('layouts.footer')

    </div>

</body>

    <script src="{!! asset('js/jquery-3.3.1.min.js') !!}"></script>

    <script src="{{ asset('js/uiux.js') }}"></script>


    @yield('scripts')


    <script>
        $(document).ready(function () {
           adjust();
        });
        $(window).resize(adjust());
    </script>

</html>

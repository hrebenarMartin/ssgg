<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="sk"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="sk"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="sk"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="sk">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/vendors/font-awesome/css/font-awesome.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/vendors/themify-icons/css/themify-icons.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/vendors/flag-icon-css/css/flag-icon.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/vendors/selectFX/css/cs-skin-elastic.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/vendors/jqvmap/dist/jqvmap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/toastr.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/css/custom.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/animate.css') !!}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>

    @yield('page_css')

    <title>@yield('title') - SSGG Admin</title>

</head>

<body>

@include('backend.layouts.left_menu')

<div id="right-panel" class="right-panel">
    @include('backend.layouts.header')
    <div class="content mt-3">
        @if(session('message') and session('message_type'))
            <div class="col-12">
                <div class="alert  alert-{{ session('message_type') }} alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        @yield('content')

        @php
            session()->forget(['message','message_type']);
        @endphp

    </div>
</div>

<script src="{!! asset('js/app.js') !!}"></script>
<script src="{!! asset('backend/js/main.js') !!}"></script>
<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"
        integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP"
        crossorigin="anonymous"></script>
<script src="{!! asset('js/jquery-3.3.1.min.js') !!}"></script>
<script src="{!! asset('backend/vendors/jquery-validation/dist/jquery.validate.js') !!}"></script>
<script src="{!! asset('backend/js/sweetalert.min.js') !!}"></script>
<script src="{!! asset('js/toastr.min.js') !!}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

@yield('scripts')

</body>
</html>

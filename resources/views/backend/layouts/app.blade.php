<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
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
{{--
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
--}}
    <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    -->
    <link rel="stylesheet" href="{!! asset('backend/vendors/themify-icons/css/themify-icons.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/vendors/flag-icon-css/css/flag-icon.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/vendors/selectFX/css/cs-skin-elastic.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/vendors/jqvmap/dist/jqvmap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/toastr.css') !!}">


    <link rel="stylesheet" href="{!! asset('backend/css/style.css') !!}">

    <link rel="stylesheet" href="{!! asset('backend/css/custom.css') !!}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    @yield('page_css')
    <title>@yield('title') - SSGG Admin</title>

</head>

<body>


@include('backend.layouts.left_menu')

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header">

        <div class="header-menu">

            <div class="col-sm-7">
                <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa-tasks"></i></a>
                <div class="header-left">
                    <button class="search-trigger"><i class="fa fa-search"></i></button>
                    <div class="form-inline">
                        <form class="search-form">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                            <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(!$user_data->image)
                            @if($user_data->gender == 'M')
                                <img class="user-avatar rounded-circle" src="{!! asset('images/placeholders/user_m.png') !!}" alt="User Avatar">
                            @elseif($user_data->gender == 'F')
                                <img class="user-avatar rounded-circle" src="{!! asset('images/placeholders/user_f.png') !!}" alt="User Avatar">
                            @else
                                <img class="user-avatar rounded-circle" src="{!! asset('images/placeholders/user_o.png') !!}" alt="User Avatar">
                            @endif
                        @else
                            <img class="user-avatar rounded-circle" src="{!! asset('public/images/profiles/'.$user_data->id.'/'.$user_data->image) !!}" alt="User Avatar">
                        @endif
                    </a>
                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="{{ route('user.profile.show', Auth::id()) }}"><i class="fa fa-user"></i> My Profile</a>
                        <a class="nav-link" href="#!"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i> {{ __('Main.Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

                <div class="pull-right" style="padding-top: 5px; padding-right: 2em">
                    <button class="btn btn-sm">{{ __('main.language_change') }}: </button>
                    @if(App::isLocale('en'))
                        <a href="{{route('set_locale', 'sk')}}" class="btn btn-primary btn-sm" style="border-radius: 20%">SK</a>
                    @else
                        <a href="{{route('set_locale', 'en')}}" class="btn btn-primary btn-sm" style="border-radius: 20%">EN</a>
                    @endif
                </div>
            </div>
        </div>

    </header><!-- /header -->
    <!-- Header-->

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

    </div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->

@yield('scripts_before')

<script src="{!! asset('js/app.js') !!}"></script>
{{--
<script src="{!! asset('backend/vendors/popper.js/dist/popper.min.js') !!}"></script>
--}}
<script src="{!! asset('backend/js/main.js') !!}"></script>

<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>


{{--<script src="{!! asset('backend/vendors/chart.js/dist/Chart.bundle.min.js') !!}"></script>
<script src="{!! asset('backend/js/dashboard.js') !!}"></script>
<script src="{!! asset('backend/js/widgets.js') !!}"></script>
<script src="{!! asset('backend/vendors/jqvmap/dist/jquery.vmap.min.js') !!}"></script>
<script src="{!! asset('backend/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') !!}"></script>
<script src="{!! asset('backend/vendors/jqvmap/dist/maps/jquery.vmap.world.js') !!}"></script>--}}

<script src="{!! asset('js/jquery-3.3.1.min.js') !!}"></script>

<script src="{!! asset('backend/vendors/jquery-validation/dist/jquery.validate.js') !!}"></script>

<script src="{!! asset('backend/js/sweetalert.min.js') !!}"></script>
<script src="{!! asset('js/toastr.min.js') !!}"></script>


<script>

</script>

@yield('scripts')

</body>
</html>

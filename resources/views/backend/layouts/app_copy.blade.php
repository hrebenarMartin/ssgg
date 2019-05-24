<!doctype html>
<html lang="sk">
<head>
    <meta charset="utf-8">...
    <!-- META tagy -->
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">...
    <!-- pripojené základné štýly -->

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
            @php
                session()->forget(['message','message_type']);
            @endphp
        @endif

        @yield('content')

    </div>
</div>
<script src="{!! asset('js/app.js') !!}"></script>...
<!-- Pripojené JavaScript súbory -->

@yield('scripts')

</body>
</html>

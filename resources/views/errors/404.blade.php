{{--
@extends('errors::illustrated-layout')

@section('code', '404')
@section('title', __('Page Not Found'))

@section('image')
    <div style="background-image: url({{ asset('/svg/404.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Sorry, the page you are looking for could not be found.'))
--}}

@extends('backend.layouts.app')

@section('title', "404")

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="display-1 text-center">404</h1>
                    <hr>
                    <h1 class="text-center">{{ __('messages.404') }}</h1>
                </div>
            </div>
        </div>
    </div>
@stop


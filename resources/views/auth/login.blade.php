@extends('layouts.app')

@section('content')
<section class="section section-shaped section-lg">
    <div class="shape shape-style-1 bg-gradient-default">
        <span class="animated infinite delay-1s pulse slow"></span>
        <span class="animated infinite delay-2s pulse slower"></span>
        <span class="animated infinite delay-1s pulse slow"></span>
        <span class="animated infinite delay-3s pulse slow"></span>
        <span class="animated infinite delay-1s pulse slow"></span>
        <span class="animated infinite delay-2s pulse slower"></span>
        <span class="animated infinite delay-5s pulse slow"></span>
        <span class="animated infinite delay-2s pulse slower"></span>
    </div>
    <div class="container pt-lg-md">
        <div class="row justify-content-center pb-100">
            <div class="col-lg-5">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header text-center">
                        <h2>{{__('main.login_card')}}</h2>
                    </div>
                    @if(session()->has('errors'))
                        <div class="col-12">
                            <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                                {{ session()->get('errors')->get('email')[0] }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="card-body px-lg-5 py-lg-5">

                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    </div>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                    </div>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                </div>
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                                <label class="custom-control-label" for=" customCheckLogin">
                                    <span>{{__('main.remember_me')}}</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('main.login') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="{{ route('password.request') }}" class="text-light">
                            <small>{{ __('main.forgot_pass') }}</small>
                        </a>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{route('register')}}" class="text-light">
                            <small>{{__('main.create_account')}}</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

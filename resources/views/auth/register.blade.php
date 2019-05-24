@extends('layouts.app')

@section('content')
<section class="section section-shaped section-lg">
    <div class="shape shape-style-1 bg-gradient-default">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="container pt-lg-md">
        <div class="row justify-content-center pb-100">
            <div class="col-lg-5">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header text-center">
                        <h2>{{__('main.register_card')}}</h2>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group mb-3 {{ $errors->has('name') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                                    </div>
                                    <input id="text" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Ján Mrkvička" required autofocus>
                                </div>
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            </div>

                            <div class="form-group mb-3 {{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    </div>
                                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="janicko@email.sk" required>
                                </div>
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                    </div>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                </div>
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                    </div>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" value="1" id="customCheckLogin" name="confirm" type="checkbox" required>
                                <label class="custom-control-label" for="customCheckLogin">
                                    <span>
                                        * Zaškrtnutím tohto poľa a odoslaním regisrácie suhlasíte s našimi <a href="#!">podmienkami o spracovaní osobných údajov</a>.
                                    </span>
                                </label>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('main.register') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="{{ route('login') }}" class="text-light">
                            <small>{{ __('main.login') }}</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

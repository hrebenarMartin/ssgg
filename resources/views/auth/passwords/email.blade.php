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
        <section class="container pt-lg-md">
            <div class="row justify-content-center pb-100">
                <div class="col-lg-5">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-header text-center">
                            <h2>{{__('main.reset_pass_1')}}</h2>
                        </div>
                        @if(session()->has('errors'))
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session()->get('errors')->get('email')[0] }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <div class="card-body px-lg-5" style="padding-bottom: 3rem; padding-top: 1rem">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <p>{{ __('main.reset_pass_help_1') }}</p>

                                <div class="form-group">
                                    <label for="email"
                                           class="col-md-4 col-form-label">{{ __('form.email') }}</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input id="email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email" value="{{ old('email') }}" required autofocus>
                                    </div>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('main.reset_pass_send_link') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection

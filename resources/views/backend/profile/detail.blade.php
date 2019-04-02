@extends('backend.layouts.app')

@section('title', __('titles.profile_detail'))

@section('content')
    <div class="col-md-12">
        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    @if(Auth::id() == $profile->user_id  || Auth::user()->access_level == 4)<a href="{{ route('user.profile.edit', $profile->user_id) }}" class="btn btn-success">{{ __('form.action_edit_profile') }}</a>@endif
                    <a href="{{ route('dashboard.index') }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> {{ __('form.action_dashboard') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">
                <h4><strong class="card-title">{{ __('form.profile_detail') }}</strong></h4>
            </div>
            <div class="card-body">
                <div class="row animated fadeIn">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-user"></i> {{ __('form.profile') }}
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    @if(!$profile->image)
                                        @if($profile->gender == 'M')
                                            <img class="mx-auto d-block" src="{!! asset('images/placeholders/user_m.png') !!}" alt="Profile picture" width="200">
                                        @elseif($profile->gender == 'F')
                                            <img class="mx-auto d-block" src="{!! asset('images/placeholders/user_f.png') !!}" alt="Profile picture" width="200">
                                        @else
                                            <img class="mx-auto d-block" src="{!! asset('images/placeholders/user_o.png') !!}" alt="Profile picture" width="200">
                                        @endif
                                    @else
                                        <img class="rounded-circle mx-auto d-block" src="{!! asset('public/images/profiles/'.$profile->id.'/'.$profile->image) !!}" alt="Profile picture" width="200">
                                    @endif
                                    <h4 class="text-sm-center mt-2 mb-1 text-"><strong>{{ $profile->title_before." ".$profile->first_name." ".$profile->middle_name." ".$profile->last_name." ".$profile->title_after }}</strong></h4>
                                        @if($user->access_level == 4)
                                            <h4 class="text-sm-center mt-2 mb-1 text-muted">
                                                <strong>{{__('main.superadmin')}}</strong>
                                            </h4>
                                        @elseif($user->access_level == 3)
                                            <h4 class="text-sm-center mt-2 mb-1 text-muted">
                                                <strong>{{__('main.admin')}}</strong>
                                            </h4>
                                        @elseif($user->access_level == 2)
                                            <h4 class="text-sm-center mt-2 mb-1 text-muted">
                                                <strong>{{__('main.reviewer')}}</strong>
                                            </h4>
                                        @elseif($user->access_level == 1)
                                            <h4 class="text-sm-center mt-2 mb-1 text-muted">
                                                <strong>{{__('main.reguser')}}</strong>
                                            </h4>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-header">
                                {{ __('form.profile_basic_information') }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 text-right">
                                        <strong>{{ __('form.email') }}:</strong>
                                    </div>
                                    <div class="col-sm-6">
                                        {{ $profile->email }}
                                    </div>

                                    <div class="col-sm-6 text-right">
                                        <strong>{{ __('form.profile_gender') }}:</strong>
                                    </div>
                                    <div class="col-sm-6">
                                        @if ($profile->gender == "M")
                                            {{ __('form.profile_gender_m') }}
                                        @elseif ($profile->gender == "F")
                                            {{ __('form.profile_gender_f') }}
                                        @else
                                            {{ __('form.profile_gender_o') }}
                                        @endif
                                    </div>

                                    <div class="col-sm-6 text-right">
                                        <strong>{{ __('form.profile_birthday') }}:</strong>
                                    </div>
                                    <div class="col-sm-6">
                                        {{ $profile->birthday }}
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <strong>{{ __('form.profile_age') }}:</strong>
                                    </div>
                                    <div class="col-sm-6">
                                        NYI
                                    </div>

                                    <div class="col-sm-6 text-right">
                                        <strong>{{ __('form.profile_phone') }}:</strong>
                                    </div>
                                    <div class="col-sm-6">
                                        {{ $profile->phone }}
                                    </div>

                                    <div class="col-sm-6 text-right">
                                        <strong>{{ __('form.profile_ico') }}:</strong>
                                    </div>
                                    <div class="col-sm-6">
                                        {{ $profile->ico }}
                                    </div>

                                    <div class="col-sm-6 text-right">
                                        <strong>{{ __('form.profile_dic') }}:</strong>
                                    </div>
                                    <div class="col-sm-6">
                                        {{ $profile->dic }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6 text-right">
                                        <strong>{{ __('form.profile_workplace') }}:</strong>
                                    </div>
                                    <div class="col-sm-6">
                                        {{ $profile->workplace }}
                                    </div>

                                    <div class="col-sm-6 text-right">
                                        <strong>{{ __('form.profile_country') }}:</strong>
                                    </div>
                                    <div class="col-sm-6">
                                        {{ $profile->country->name_sk }}
                                    </div>

                                    <div class="col-sm-6 text-right">
                                        <strong>{{ __('form.profile_city') }}:</strong>
                                    </div>
                                    <div class="col-sm-6">
                                        {{ $profile->address_city }}
                                    </div>

                                    <div class="col-sm-6 text-right">
                                        <strong>{{ __('form.profile_street') }}:</strong>
                                    </div>
                                    <div class="col-sm-6">
                                        {{ $profile->address_street }}
                                    </div>

                                    <div class="col-sm-6 text-right">
                                        <strong>{{ __('form.profile_psc') }}:</strong>
                                    </div>
                                    <div class="col-sm-6">
                                        {{ $profile->address_psc }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

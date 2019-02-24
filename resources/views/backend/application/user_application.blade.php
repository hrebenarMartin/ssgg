@extends('backend.layouts.app')

@section('title', __('titles.my_application'))

@section('content')
    <div class="col-md-12">
        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('dashboard.index') }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> {{ __('form.action_dashboard') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">
                {{ __('titles.my_application') }}
            </div>
            @if(isset($no_conference))
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>{{ __('messages.no_conference_in_progress') }}</h2>
                        </div>
                    </div>
                </div>
            @else
                <div class="container">
                    <div class="row">
                        <div class="col-12 p-5">
                            <div class="text-center">
                                <h1>{{App::getLocale() == 'en' ? $conference->title_en : $conference->title_sk}}</h1>
                                <br>
                                <h1>{{$conference->year}}</h1>
                            </div>

                        </div>
                        @if($has_application)
                            <div class="col-12 p-5">
                                <div class="col-5 text-center">
                                    <h2>My application</h2>
                                </div>
                                <div class="col-2">
                                    <hr>
                                </div>
                                <div class="col-5 text-center">
                                    @if($appl->status == 1)
                                        <h2 class="text-primary">Not confirmed, Created</h2>
                                    @elseif($appl->status == 2)
                                        <h2>Confirmed, <span class="text-danger animated infinite slower flash">Payment not recieved yet</span></h2>
                                    @else
                                        <h2>Confirmed, <span class="text-success">Payment recieved</span></h2>
                                    @endif
                                </div>
                                <div class="col-12 p-3">
                                    <div class="col-6">
                                        <h3 style="padding: 1em 0">{{__('application.chosen_accommodation')}}</h3>
                                            @if($config->accom_1 == 1)
                                                <p><i class="fa @if($appl->accom_1 == 1) fa-check text-success @else fa-times text-danger @endif"></i> <strong>{{__('form.conference_room1')}}:</strong> {{__('main.cost')}} <strong><u>{{$config->accom_1_price}} €</u></strong></p>
                                            @endif
                                            @if($config->accom_2 == 1)
                                                <p><i class="fa @if($appl->accom_2 == 1) fa-check text-success @else fa-times text-danger @endif"></i> <strong>{{__('form.conference_room2')}}:</strong> {{__('main.cost')}} <strong><u>{{$config->accom_2_price}} €</u></strong></p>
                                            @endif
                                            @if($config->accom_3 == 1)
                                                <p><i class="fa @if($appl->accom_3 == 1) fa-check text-success @else fa-times text-danger @endif"></i> <strong>{{__('form.conference_room3')}}:</strong> {{__('main.cost')}} <strong><u>{{$config->accom_3_price}} €</u></strong></p>
                                            @endif
                                            @if($config->accom_4 == 1)
                                                <p><i class="fa @if($appl->accom_4 == 1) fa-check text-success @else fa-times text-danger @endif"></i> <strong>{{__('form.conference_room4')}}:</strong> {{__('main.cost')}} <strong><u>{{$config->accom_4_price}} €</u></strong></p>
                                            @endif
                                            @if($config->accom_5 == 1)
                                                <p><i class="fa @if($appl->accom_5 == 1) fa-check text-success @else fa-times text-danger @endif"></i> <strong>{{__('form.conference_room5')}}:</strong> {{__('main.cost')}} <strong><u>{{$config->accom_5_price}} €</u></strong></p>
                                            @endif
                                        <h3 style="padding: 1em 0">{{__('application_chosen_special_events')}}</h3>
                                        @if($config->special_1 == 1)
                                            <p><i class="fa @if($appl->special_1 == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{ App::getLocale() == 'en' ? $config->special_1_en : $config->special_1_sk  }}</p>
                                        @endif
                                        @if($config->special_2 == 1)
                                            <p><i class="fa @if($appl->special_2 == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{ App::getLocale() == 'en' ? $config->special_2_en : $config->special_2_sk  }}</p>
                                        @endif
                                        @if($config->special_3 == 1)
                                            <p><i class="fa @if($appl->special_3 == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{ App::getLocale() == 'en' ? $config->special_3_en : $config->special_3_sk  }}</p>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <h3 style="padding: 1em 0">{{__('application.chosen_food')}}</h3>
                                        @php
                                            $days = \Carbon\Carbon::createFromFormat('Y-m-d', $conference->conference_end)->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d', $conference->conference_start));
                                        @endphp
                                        @for ($i = 1; $i <= $days+1; $i++)
                                            <div class="col-6">
                                                <p><strong>{{__('form.conference_day')}} {{$i}}. ( {{\Carbon\Carbon::createFromFormat('Y-m-d', $conference->conference_start)->addDays(($i-1))->format('d M,Y')}} ):</strong>
                                                    @if($config["day".intval($i)."_breakfast"] == 1)<br>&nbsp; &nbsp; &nbsp;<strong><i class="fa @if($appl["day".intval($i)."_breakfast"] == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{__('form.conference_breakfast')}}</strong>@endif
                                                    @if($config["day".intval($i)."_lunch"] == 1)<br>&nbsp; &nbsp; &nbsp;<strong><i class="fa @if($appl["day".intval($i)."_lunch"] == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{__('form.conference_lunch')}}</strong>@endif
                                                    @if($config["day".intval($i)."_dinner"] == 1)<br>&nbsp; &nbsp; &nbsp;<strong><i class="fa @if($appl["day".intval($i)."_dinner"] == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{__('form.conference_dinner')}}</strong>@endif
                                                </p>
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="col-12">
                                        <h3 style="padding: 1em 0">{{__('application.extra')}}</h3>
                                        <p>{{$appl->extra}}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12">
                                <h2 class="text-danger text-center">No application for this conference yet</h2>
                            </div>
                            <div class="col-12 text-center p-5">
                                <a href="{{route('user.application.create')}}" class="btn btn-outline-success btn-lg animated pulse infinite slow">Apply now!</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>


    </div>
@stop

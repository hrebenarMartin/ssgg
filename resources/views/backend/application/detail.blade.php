@extends('backend.layouts.app')

@section('title', __('titles.application_detail'))

@section('content')
    <div class="col-md-12">

        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('dashboard.index') }}" class="btn btn-primary"><i
                            class="fa fa-fw fa-chevron-circle-left"></i> {{ __('form.action_dashboard') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{ __('form.conference_participants_application') }}</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="col-3 text-center">
                            @if($appl->user->profile->image)
                                <img
                                    src="{{asset('images/profiles/'.$appl->user->id."/".$appl->user->profile->image)}}" class="img-circle" style="max-width: 100px">
                            @else
                                <img
                                    src="{{asset('images/placeholders/user_o.png')}}" class="img-circle" style="max-width: 100px">
                            @endif
                        </div>
                        <div class="col-9" style="padding-top: 1em">
                            <h3>{{ $appl->user->name }}</h3>
                        </div>
                    </div>
                    <div class="col-12 p-3">
                        <div class="col-6">
                            <h3 style="padding: 1em 0">{{__('application.chosen_accommodation')}}</h3>
                            @php
                                $config = $appl->conference->config
                            @endphp
                            @if($config->accom_1 == 1)
                                <p>
                                    <i class="fa @if($appl->accom_1 == 1) fa-check text-success @else fa-times text-danger @endif"></i>
                                    <strong>{{__('form.conference_room1')}}:</strong> {{__('main.cost')}}
                                    <strong><u>{{$config->accom_1_price}} €</u></strong></p>
                            @endif
                            @if($config->accom_2 == 1)
                                <p>
                                    <i class="fa @if($appl->accom_2 == 1) fa-check text-success @else fa-times text-danger @endif"></i>
                                    <strong>{{__('form.conference_room2')}}:</strong> {{__('main.cost')}}
                                    <strong><u>{{$config->accom_2_price}} €</u></strong></p>
                            @endif
                            @if($config->accom_3 == 1)
                                <p>
                                    <i class="fa @if($appl->accom_3 == 1) fa-check text-success @else fa-times text-danger @endif"></i>
                                    <strong>{{__('form.conference_room3')}}:</strong> {{__('main.cost')}}
                                    <strong><u>{{$config->accom_3_price}} €</u></strong></p>
                            @endif
                            @if($config->accom_4 == 1)
                                <p>
                                    <i class="fa @if($appl->accom_4 == 1) fa-check text-success @else fa-times text-danger @endif"></i>
                                    <strong>{{__('form.conference_room4')}}:</strong> {{__('main.cost')}}
                                    <strong><u>{{$config->accom_4_price}} €</u></strong></p>
                            @endif
                            @if($config->accom_5 == 1)
                                <p>
                                    <i class="fa @if($appl->accom_5 == 1) fa-check text-success @else fa-times text-danger @endif"></i>
                                    <strong>{{__('form.conference_room5')}}:</strong> {{__('main.cost')}}
                                    <strong><u>{{$config->accom_5_price}} €</u></strong></p>
                            @endif
                            <p>
                                <i class="fa @if($appl->accom_98 == 1) fa-check text-success @else fa-times text-danger @endif"></i>
                                <strong>{{__('application.accom_no_preference')}}:</strong></p>
                            <p>
                                <i class="fa @if($appl->accom_99 == 1) fa-check text-success @else fa-times text-danger @endif"></i>
                                <strong>{{__('application.accom_no_accommodation')}}:</strong></p>

                            <h3 style="padding: 1em 0">{{__('application.chosen_special_events')}}</h3>
                            @if($config->special_1 == 1)
                                <p>
                                    <i class="fa @if($appl->special_1 == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{ App::getLocale() == 'en' ? $config->special_1_en : $config->special_1_sk  }}
                                </p>
                            @endif
                            @if($config->special_2 == 1)
                                <p>
                                    <i class="fa @if($appl->special_2 == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{ App::getLocale() == 'en' ? $config->special_2_en : $config->special_2_sk  }}
                                </p>
                            @endif
                            @if($config->special_3 == 1)
                                <p>
                                    <i class="fa @if($appl->special_3 == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{ App::getLocale() == 'en' ? $config->special_3_en : $config->special_3_sk  }}
                                </p>
                            @endif
                        </div>
                        <div class="col-6">
                            <h3 style="padding: 1em 0">{{__('application.chosen_food')}}</h3>
                            @php
                                $days = \Carbon\Carbon::createFromFormat('Y-m-d', $appl->conference->conference_end)->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d', $appl->conference->conference_start));
                            @endphp
                            @for ($i = 1; $i <= $days+1; $i++)
                                <div class="col-6">
                                    <p><strong>{{__('form.conference_day')}} {{$i}}.
                                            ( {{\Carbon\Carbon::createFromFormat('Y-m-d', $appl->conference->conference_start)->addDays(($i-1))->format('d M,Y')}}
                                            ):</strong>
                                        @if($config["day".intval($i)."_breakfast"] == 1)<br>&nbsp; &nbsp;
                                        &nbsp;<strong><i
                                                class="fa @if($appl["day".intval($i)."_breakfast"] == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{__('form.conference_breakfast')}}
                                        </strong>@endif
                                        @if($config["day".intval($i)."_lunch"] == 1)<br>&nbsp; &nbsp; &nbsp;
                                        <strong><i
                                                class="fa @if($appl["day".intval($i)."_lunch"] == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{__('form.conference_lunch')}}
                                        </strong>@endif
                                        @if($config["day".intval($i)."_dinner"] == 1)<br>&nbsp; &nbsp;
                                        &nbsp;<strong><i
                                                class="fa @if($appl["day".intval($i)."_dinner"] == 1) fa-check text-success @else fa-times text-danger @endif"></i> {{__('form.conference_dinner')}}
                                        </strong>@endif
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
            </div>
        </div>
    </div>
@stop

@extends('backend.layouts.app')

@section('title', __('titles.my_application'))

@section('content')
    <div class="col-md-12">
        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('dashboard.index') }}" class="btn btn-primary"><i
                            class="fa fa-chevron-circle-left"></i> {{ __('form.action_dashboard') }}</a>
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
                                    <h2>{{ __('application.myApplication') }}</h2>
                                </div>
                                <div class="col-2">
                                    <hr>
                                </div>
                                <div class="col-5 text-center">
                                    @if($appl->status == 1)
                                        <h2 class="text-primary">{{ __('application.status_1') }}</h2>
                                    @elseif($appl->status == 2)
                                        <h2>Confirmed, <span
                                                class="text-danger animated infinite slower flash">{{ __('application.status_2') }}</span>
                                        </h2>
                                    @else
                                        <h2>Confirmed, <span
                                                class="text-success">{{ __('application.status_3') }}</span></h2>
                                    @endif
                                </div>
                                <div class="col-12" style="margin-top: 1.5em">
                                    <button type="button" class="btn btn-danger pull-right"><i
                                            class="fa fa-trash"></i> {{__('main.delete')}}</button>
                                    <a href="{{route('user.application.edit', $appl->id)}}"
                                       class="btn btn-success pull-right" style="margin: 0 0.5em"><i
                                            class="fa fa-edit"></i> {{__('main.edit')}}</a>
                                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                                            data-target="#confirm_modal"><i
                                            class="fa fa-check-circle"></i> {{__('main.confirm')}}</button>
                                </div>
                                <div class="modal animated fadeInDown" tabindex="-1" role="dialog" id="confirm_modal">
                                    <div class="modal-dialog modal-lg animate fadeInDown">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="text-muted">Ako si prajete zaplatiť?</h2>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <button type="button" data-dismiss="modal"
                                                                    data-toggle="modal" data-target="#bank_modal"
                                                                    class="btn btn-lg btn-outline-info"
                                                                    style="width: 100%; height: 100%; border-width: 3px; padding: 3em 0">
                                                                <h2>
                                                                    <i class="far fa-credit-card fa-3x"></i><br><br>
                                                                    Platba na účet
                                                                </h2>
                                                                <small>Preferovaná voľba</small>
                                                            </button>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <a href="#!" class="btn btn-lg btn-outline-primary"
                                                               style="width: 100%; height: 100%; border-width: 3px; padding: 3em 0">
                                                                <h2>
                                                                    <i class="fa fa-hand-holding-usd fa-3x"></i><br><br>
                                                                    Platba na mieste
                                                                </h2>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal animated fadeInDown" tabindex="-1" role="dialog" id="bank_modal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="text-muted">Platba bankovým prevodom</h2>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p>Detaily k poukázaniu poplatku bankovým prevodom</p>
                                                        <div class="container">
                                                            <ul>
                                                                <li>Jednotná cena <strong>55€</strong></li>
                                                                <li>Banka: xxxxxxxxxxxx</li>
                                                                <li>Názov účtu: xxxxxxxxxxxxxxxx</li>
                                                                <li>Číslo účtu: xxxxxxxxxx</li>
                                                                <li>Kód banky: xxxx</li>
                                                                <li>Variabilný symbol: [[ USER Variable symbol here ]]</li>
                                                                <li>IČ: xxxxxxxxx</li>
                                                                <li>SWIFT: xxxxxxxxxx</li>
                                                                <li>IBAN: SKxxxx000000xxxxxxxxxxxx</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p>
                                                            Ako postupovať?
                                                        </p>
                                                        <div class="container">
                                                            <ul>
                                                                <li>Potvrďte svoju voľbu zeleným tlačidlom dole</li>
                                                                <li>Detaily k platbe vám budú prístupné aj naďalej</li>
                                                                <li>Stav zaplatenia vašej prihlášky nájdete vo vašej prihláške a budeme vás informovať aj mailom</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="#!" class="btn btn-success">Budem platiť prevodom</a>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    Zrušiť
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 p-3">
                                    <div class="col-6">
                                        <h3 style="padding: 1em 0">{{__('application.chosen_accommodation')}}</h3>
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
                                            $days = \Carbon\Carbon::createFromFormat('Y-m-d', $conference->conference_end)->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d', $conference->conference_start));
                                        @endphp
                                        @for ($i = 1; $i <= $days+1; $i++)
                                            <div class="col-6">
                                                <p><strong>{{__('form.conference_day')}} {{$i}}.
                                                        ( {{\Carbon\Carbon::createFromFormat('Y-m-d', $conference->conference_start)->addDays(($i-1))->format('d M,Y')}}
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
                        @else
                            <div class="col-12">
                                <h2 class="text-danger text-center">No application for this conference yet</h2>
                            </div>
                            <div class="col-12 text-center p-5">
                                <a href="{{route('user.application.create')}}"
                                   class="btn btn-outline-success btn-lg animated pulse infinite slow">Apply now!</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

    </div>
@stop
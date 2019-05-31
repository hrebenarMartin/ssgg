@extends('backend.layouts.app')

@section('title', __('titles.my_application'))

@section('content')
    <div class="col-md-12">
        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('user.application.index') }}" class="btn btn-primary"><i
                            class="fa fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">
                {{ __('titles.my_application_create') }}
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 p-5">
                        <div class="col-4">
                            <hr>
                        </div>
                        <div class="col-4 text-center">
                            <h2>{{__('application.creating_application')}}</h2>
                        </div>
                        <div class="col-4">
                            <hr>
                        </div>
                        <div class="col-12 p-3">
                            <form method="POST" action="{{ route('user.application.store') }}">
                                @csrf

                                <div class="col-6">
                                    <!-- Preferencie ubytovania -->
                                    <h3 style="padding: 1em 0">{{__('application.chosen_accommodation')}}</h3>
                                    <div class="row form-group">
                                        <div class="col-12 form-check">
                                            @if($config->accom_1 == 1)
                                                <div class="radio">
                                                    <label for="accom_1" class="form-check-label">
                                                        <input type="radio" id="accom_1" name="accom" value="1"
                                                               class="form-check-input">
                                                        <strong>{{__('form.conference_room1')}}
                                                            :</strong> {{__('main.cost')}}
                                                        <strong><u>{{$config->accom_1_price}} €</u></strong>
                                                    </label>
                                                </div>
                                            @endif
                                            @if($config->accom_2 == 1)
                                                <div class="radio">
                                                    <label for="accom_2" class="form-check-label">
                                                        <input type="radio" id="accom_2" name="accom" value="2"
                                                               class="form-check-input">
                                                        <strong>{{__('form.conference_room2')}}
                                                            :</strong> {{__('main.cost')}}
                                                        <strong><u>{{$config->accom_2_price}} €</u></strong>
                                                    </label>
                                                </div>
                                            @endif
                                            @if($config->accom_3 == 1)
                                                <div class="radio">
                                                    <label for="accom_3" class="form-check-label">
                                                        <input type="radio" id="accom_3" name="accom" value="3"
                                                               class="form-check-input">
                                                        <strong>{{__('form.conference_room3')}}
                                                            :</strong> {{__('main.cost')}}
                                                        <strong><u>{{$config->accom_3_price}} €</u></strong>
                                                    </label>
                                                </div>
                                            @endif
                                            @if($config->accom_4 == 1)
                                                <div class="radio">
                                                    <label for="accom_4" class="form-check-label">
                                                        <input type="radio" id="accom_4" name="accom" value="4"
                                                               class="form-check-input">
                                                        <strong>{{__('form.conference_room4')}}
                                                            :</strong> {{__('main.cost')}}
                                                        <strong><u>{{$config->accom_4_price}} €</u></strong>
                                                    </label>
                                                </div>
                                            @endif
                                            @if($config->accom_5 == 1)
                                                <div class="radio">
                                                    <label for="accom_5" class="form-check-label">
                                                        <input type="radio" id="accom_5" name="accom" value="5"
                                                               class="form-check-input">
                                                        <strong>{{__('form.conference_room5')}}
                                                            :</strong> {{__('main.cost')}}
                                                        <strong><u>{{$config->accom_5_price}} €</u></strong>
                                                    </label>
                                                </div>
                                            @endif
                                            <div class="radio">
                                                <label for="accom_98" class="form-check-label">
                                                    <input type="radio" id="accom_98" name="accom" value="98"
                                                           class="form-check-input">
                                                    <strong>{{__('application.accom_no_preference')}}</strong>
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label for="accom_99" class="form-check-label">
                                                    <input type="radio" id="accom_99" name="accom" value="99"
                                                           class="form-check-input" checked>
                                                    <strong>{{__('application.accom_no_accommodation')}}</strong>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Preferencie špecialnych udalostí -->
                                    <h3 style="padding: 1em 0">{{__('application.chosen_special_events')}}</h3>
                                    <h4 style="padding-bottom: 1em">{{__('application.chosen_special_events_attendance')}}
                                        :</h4>
                                    <div class="row form-group">
                                        <div class="col-12 form-check">
                                            @if($config->special_1 == 1)
                                                <div class="checkbox">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" value="1"
                                                               name="special_1">{{ App::getLocale() == 'en' ? $config->special_1_en : $config->special_1_sk  }}
                                                    </label>
                                                </div>
                                            @endif
                                            @if($config->special_2 == 1)
                                                <div class="checkbox">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" value="1"
                                                               name="special_2">{{ App::getLocale() == 'en' ? $config->special_2_en : $config->special_2_sk  }}
                                                    </label>
                                                </div>
                                            @endif
                                            @if($config->special_3 == 1)
                                                <div class="checkbox">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" value="1"
                                                               name="special_3">{{ App::getLocale() == 'en' ? $config->special_3_en : $config->special_3_sk  }}
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!-- Preferencie stravovania -->
                                    <h3 style="padding: 1em 0">{{__('application.chosen_food')}}</h3>
                                    <div class="row form-group">
                                        <div class="col-12 form-check">
                                            @php
                                                $days = \Carbon\Carbon::createFromFormat('Y-m-d', $conference->conference_end)->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d', $conference->conference_start));
                                            @endphp
                                            @for ($i = 1; $i <= $days+1; $i++)
                                                <div class="col-6" style="padding-bottom: 1em">
                                                    {{__('form.conference_day')." ".$i}}
                                                    {{"(".\Carbon\Carbon::createFromFormat('Y-m-d', $conference->conference_start)->addDays(($i-1))->format('d M,Y')."):" }}
                                                    <div class="container" style="padding-left: 2em">
                                                        @if($config["day".intval($i)."_breakfast"] == 1)
                                                            <div class="checkbox">
                                                                <label for="day_{{$i}}_breakfast"
                                                                       class="form-check-label">
                                                                    <input type="checkbox" id="day_{{$i}}_breakfast"
                                                                           name="day_{{$i}}_break" value="1"
                                                                           class="form-check-input">
                                                                    <strong>{{__('form.conference_breakfast')}}</strong>
                                                                </label>
                                                            </div>
                                                        @endif
                                                        @if($config["day".intval($i)."_lunch"] == 1)
                                                            <div class="checkbox">
                                                                <label for="day_{{$i}}_lunch" class="form-check-label">
                                                                    <input type="checkbox" id="day_{{$i}}_lunch"
                                                                           name="day_{{$i}}_lunch" value="1"
                                                                           class="form-check-input">
                                                                    <strong>{{__('form.conference_lunch')}}</strong>
                                                                </label>
                                                            </div>
                                                        @endif
                                                        @if($config["day".intval($i)."_dinner"] == 1)
                                                            <div class="checkbox">
                                                                <label for="day_{{$i}}_dinner" class="form-check-label">
                                                                    <input type="checkbox" id="day_{{$i}}_dinner"
                                                                           name="day_{{$i}}_dinner" value="1"
                                                                           class="form-check-input">
                                                                    <strong>{{__('form.conference_dinner')}}</strong>
                                                                </label>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- Extra požiadavky -->
                                    <h3 style="padding: 1em 0">{{__('application.extra')}}</h3>
                                    <div class="form-group">
                                        <textarea class="form-control" name="extra" id="extra"
                                                  rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-lg btn-success">
                                        {{__('form.save')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@stop

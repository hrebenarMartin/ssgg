@extends('backend.layouts.app')

@section('content')
    <div class="col-sm-12">

        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ redirect()->back() }}" class="btn btn-primary"><i
                                class="fa fa-fw fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">
                <strong class="card-title">
                    {{__('form.conference_statistics')}}
                </strong>
            </div>
            <div class="card-body">
                <div class="col-6">
                    <div class="col-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-success"><h3
                                        class="text-light">{{__('form.conference_attendees')}}
                                    : {{$stats->applications_paid}}</h3></li>
                            <li class="list-group-item">{{__('stats.applications_all')}}: {{$stats->applications_all}}</li>
                            <li class="list-group-item">{{__('stats.applications_confirmed')}}: {{$stats->applications_confirmed}}</li>
                            <li class="list-group-item">{{__('stats.applications_paid')}}: {{$stats->applications_paid}}</li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-primary"><h3 class="text-light">
                                    {{__('stats.contributions')}}: {{$stats->contributions_all}}</h3></li>
                            @foreach($stats->contributions as $c)
                                <li class="list-group-item">{{__('form.contribution_type'.$c->type)}}
                                    : {{$c->count}}</li>
                            @endforeach
                            <li class="list-group-item bg-info"><h3 class="text-light">
                                    {{__('stats.reviews')}}: {{$stats->reviews}}</h3></li>
                            <li class="list-group-item">{{__('stats.reviews_approved')}}: {{$stats->reviews_approved}}</li>
                            <li class="list-group-item">{{__('stats.reviews_rejected')}}: {{$stats->reviews_not_approved}}</li>
                            <li class="list-group-item">{{__('stats.reviews_avg_score')}}: {{$stats->reviews_avg_score}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-danger"><h3
                                    class="text-light">{{__('stats.others')}}</h3></li>
                        <li class="list-group-item bg-secondary">
                            <strong class="text-light">{{__('stats.food_ordered')}}</strong>
                        </li>
                        @php
                            $days = \Carbon\Carbon::createFromFormat('Y-m-d', $conference->conference_end)->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d', $conference->conference_start));
                        @endphp
                        @for ($i = 1; $i <= $days+1; $i++)
                            <li class="list-group-item"><strong>{{__('form.conference_day')}} {{$i}}:</strong></li>
                            <li class="list-group-item">
                                @if($config['day'.$i.'_breakfast'])
                                    <div class="col-4">{{__('form.conference_breakfast')}}
                                        : {{$stats->applications_more['d' . $i . 'b']}}x
                                    </div>
                                @endif
                                @if($config['day'.$i.'_lunch'])
                                    <div class="col-4">{{__('form.conference_lunch')}}
                                        : {{$stats->applications_more['d' . $i . 'l']}}x
                                    </div>
                                @endif
                                @if($config['day'.$i.'_dinner'])
                                    <div class="col-4">{{__('form.conference_dinner')}}
                                        : {{$stats->applications_more['d' . $i . 'd']}}x
                                    </div>
                                @endif
                            </li>
                        @endfor
                        <li class="list-group-item bg-secondary">
                            <strong class="text-light">{{__('stats.accommodation')}}</strong>
                        </li>
                        <li class="list-group-item">
                            @for ($i = 1; $i <= 5; $i++)
                                @if($config['accom_'.$i])
                                    <div class="col-6">{{__('form.conference_room'.$i).": ".$stats->applications_more['accom'.$i]}}
                                        x
                                    </div>
                                @endif
                            @endfor
                        </li>
                        <li class="list-group-item">
                            <div class="col-6">{{__('application.accom_no_preference').": ".$stats->applications_more['accom98']}}
                                x
                            </div>
                            <div class="col-6">{{__('application.accom_no_accommodation').": ".$stats->applications_more['accom99']}}
                                x
                            </div>
                        </li>
                        <li class="list-group-item bg-secondary">
                            <strong class="text-light">{{__('stats.special_events_attendance')}}</strong>
                        </li>
                        <li class="list-group-item">
                            @for ($i = 1; $i <= 3; $i++)
                                @if($config['special_'.$i])
                                    <div class="col-6">{{__('form.conference_special_event')." ".$i.": ".$stats->applications_more['special_'.$i]}}
                                        x
                                    </div>
                                @endif
                            @endfor
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
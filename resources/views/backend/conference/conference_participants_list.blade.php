@extends('backend.layouts.app')

@section('title', __('titles.conference_participants'))

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
                <strong class="card-title">{{ __('form.conference_participants_listing') }}</strong>
            </div>
            <div class="card-body">
                <h3>{{ __('application.not_confirmed') }}</h3>
                <br>
                <table class="table table-sm table-striped">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('form.application_user') }}</th>
                        <th scope="col" style="width:20%;">{{ __('form.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($not_confirmed as $appl)
                        <tr class="text-center">
                            <td scope="row">{{ $appl->id }}</td>
                            <td>
                                {{ $appl->user->profile->first_name." ".$appl->user->profile->last_name}}
                            </td>
                            <td>
                                @if(Auth::user()->roles()->where('role_id', 1)->first() or
                                (Auth::user()->roles()->where('role_id', 3)->first() and $appl->conference->status < 3))
                                    <a href="#!" data-item-id="{{ $appl->id }}"
                                       class="btn btn-danger btn-sm listing_controls pull-right delete-alert"><i
                                            class="fa fa-fw fa-times"></i></a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['user.application.destroy', $appl->id ],
                                            'id' => 'item-del-'. $appl->id  ])
                                        }}
                                    {{ Form::hidden('application_id', $appl->id) }}
                                    {{ Form::close() }}
                                    <a href="{{ route('admin.conferences.conference_participants.show', ["cid"=>$appl->conference_id, "aid"=>$appl->id]) }}"
                                       class="btn btn-primary btn-sm listing_controls pull-right"><i
                                            class="fa fa-fw fa-search"></i></a>
                                    <a href="{{ route('admin.conferences.conference_participants.confirm', ["cid"=>$appl->conference_id, "aid"=>$appl->id]) }}"
                                       class="btn btn-success btn-sm listing_controls pull-right"><i
                                            class="fa fa-fw fa-check"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <h3>{{ __('application.confirmed') }}</h3>
                <br>
                <table class="table table-sm table-striped">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('form.application_user') }}</th>
                        <th scope="col">{{ __('application.status') }}</th>
                        <th scope="col" style="width:20%;">{{ __('form.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($confirmed as $appl)
                        <tr class="text-center">
                            <td scope="row">{{ $appl->id }}</td>
                            <td>
                                {{ $appl->user->profile->first_name." ".$appl->user->profile->last_name}}
                            </td>
                            <td>{{ $appl->status == 2 ? __('application.status_2') : __('application.status_3') }}</td>
                            <td>
                                @if(Auth::user()->roles()->where('role_id', 1)->first() or
                                (Auth::user()->roles()->where('role_id', 3)->first() and $appl->conference->status < 3))
                                    <a href="#!" data-item-id="{{ $appl->id }}"
                                       class="btn btn-danger btn-sm listing_controls pull-right delete-alert"><i
                                            class="fa fa-fw fa-times"></i></a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['user.application.destroy', $appl->id ],
                                            'id' => 'item-del-'. $appl->id  ])
                                        }}
                                    {{ Form::hidden('application_id', $appl->id) }}
                                    {{ Form::close() }}
                                    <a href="{{ route('admin.conferences.conference_participants.show', ["cid"=>$appl->conference_id, "aid"=>$appl->id]) }}"
                                       class="btn btn-primary btn-sm listing_controls pull-right"><i
                                            class="fa fa-fw fa-search"></i></a>
                                    @if($appl->status == 2)
                                        <a href="{{ route('admin.conferences.conference_participants.confirm_payment', ["cid"=>$appl->conference_id, "aid"=>$appl->id]) }}"
                                           class="btn btn-success btn-sm listing_controls pull-right"><i
                                                class="fa fa-fw fa-money-bill-wave"></i></a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

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
                        <th scope="col">VS</th>
                        <th scope="col">{{ __('form.application_user') }}</th>
                        <th scope="col">{{ __('application.status') }}</th>
                        <th scope="col" style="width:20%;">{{ __('form.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($confirmed as $appl)
                        <tr class="text-center">
                            <td scope="row">{{ $appl->id }}</td>
                            <td><small>{{$appl->conference->year}}</small><b>{{str_pad($appl->user->id,5,0)}}{{str_pad($appl->id,2,0,STR_PAD_LEFT)}}</b></td>
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

        <div class="col-12">
            <div class="alert alert-info fade show" role="alert">
                <div class="row">
                    <div class="col-sm-12">
                        <i class="fa fa-lightbulb fa-fw"></i> Zoznam prihlášok na konferenciu
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        Nepotvrdené prihlášky
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-sm btn-success pull-right"><i class="fa fa-fw fa-check"></i>
                        </button>
                    </div>
                    <div class="col-sm-11">
                        - Manuálne potvrdiť prihlášku
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        Potvrdené prihlášky
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-sm btn-success pull-right"><i class="fa fa-fw fa-money-bill-wave"></i>
                        </button>
                    </div>
                    <div class="col-sm-11">
                        - Potvrdenie zaplatenej prihlášky (ak ešte nie je zaplatená nerobiť nič)
                    </div>
                </div>
                <hr>
                <div class="row py-1">
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-sm btn-primary pull-right"><i class="fa fa-fw fa-search"></i>
                        </button>
                    </div>
                    <div class="col-sm-11">
                        - Zobrazenie detailu prihlášky
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-sm btn-danger pull-right"><i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                    <div class="col-sm-11">
                        - Zmazanie prihlášky - DANGER
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>

        $(document).ready(function () {

            $('.delete-alert').click(function (e) {
                var id = $(e.currentTarget).attr("data-item-id");
                swal({
                    title: "DANGER ZONE! Are you sure you want to proceed?",
                    text: "Application will be deleted.",
                    icon: "error",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            document.getElementById('item-del-' + id).submit();
                        }
                    });
            });

        })

    </script>
@stop
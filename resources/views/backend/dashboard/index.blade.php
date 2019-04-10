@extends('backend.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="col-sm-12 mb-4">
        <div class="card-group">
            <div class="card col-lg-2 col-md-6 no-padding bg-flat-color-1">
                <div class="card-body">
                    <div class="h1 text-muted text-right mb-4">
                        <i class="fa fa-user-check text-light"></i>
                    </div>
                    <div class="h4 mb-0 text-light">
                        <span class="count">{{$stats['participants']}}</span>
                    </div>
                    <small class="text-uppercase font-weight-bold text-light">{{__('stats.participants')}}</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
            <div class="card col-lg-2 col-md-6 no-padding no-shadow">
                <div class="card-body bg-flat-color-2">
                    <div class="h1 text-muted text-right mb-4">
                        <i class="fa fa-users text-light"></i>
                    </div>
                    <div class="h4 mb-0 text-light">
                        <span class="count">{{$stats['participants_at']}}</span>
                    </div>
                    <small
                        class="text-uppercase font-weight-bold text-light">{{__('stats.participants_all_time')}}</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
            <div class="card col-lg-2 col-md-6 no-padding no-shadow">
                <div class="card-body bg-flat-color-3">
                    <div class="h1 text-right mb-4">
                        <i class="fa fa-file-alt text-light"></i>
                    </div>
                    <div class="h4 mb-0 text-light">
                        <span class="count">{{$stats['contributions']}}</span>
                    </div>
                    <small class="text-light text-uppercase font-weight-bold">{{__('stats.contributions')}}</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
            <div class="card col-lg-2 col-md-6 no-padding no-shadow">
                <div class="card-body bg-flat-color-5">
                    <div class="h1 text-right text-light mb-4">
                        <i class="far fa-file-alt"></i>
                    </div>
                    <div class="h4 mb-0 text-light">
                        <span class="count">{{$stats['contributions_at']}}</span>
                    </div>
                    <small
                        class="text-uppercase font-weight-bold text-light">{{__('stats.contributions_all_time')}}</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
            <div class="card col-lg-2 col-md-6 no-padding no-shadow">
                <div class="card-body bg-flat-color-4">
                    <div class="h1 text-light text-right mb-4">
                        <i class="fa fa-microphone-alt"></i>
                    </div>
                    <div class="h4 mb-0 text-light">{{$stats['conferences']}}</div>
                    <small class="text-light text-uppercase font-weight-bold">{{__('stats.conferences_held')}}</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
            <div class="card col-lg-2 col-md-6 no-padding no-shadow">
                <div class="card-body bg-flat-color-1">
                    <div class="h1 text-light text-right mb-4">
                        <i class="fa fa-images"></i>
                    </div>
                    <div class="h4 mb-0 text-light">
                        <span class="count">{{$stats['photos_at']}}</span>
                    </div>
                    <small class="text-light text-uppercase font-weight-bold">{{__('stats.photos_uploaded')}}</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <a href="{{route('user.profile.show', $profile->user_id)}}"
                       class="col-12 text-primary text-center"><h4><i
                                class="fa fa-user"></i> {{$profile->first_name." ".$profile->last_name}}</h4></a>
                </div>
            </div>
            <div class="card-body">
                <div class="mx-auto d-block">
                    @if(!$profile->image)
                        @if($profile->gender == 'M')
                            <img class="mx-auto d-block"
                                 src="{!! asset('images/placeholders/user_m.png') !!}"
                                 alt="Profile picture" width="200">
                        @elseif($profile->gender == 'F')
                            <img class="mx-auto d-block"
                                 src="{!! asset('images/placeholders/user_f.png') !!}"
                                 alt="Profile picture" width="200">
                        @else
                            <img class="mx-auto d-block"
                                 src="{!! asset('images/placeholders/user_o.png') !!}"
                                 alt="Profile picture" width="200">
                        @endif
                    @else
                        <img class="rounded-circle mx-auto d-block"
                             src="{!! asset('public/images/profiles/'.$profile->user_id.'/'.$profile->image) !!}"
                             alt="Profile picture" width="200">
                    @endif
                    <p></p>
                    <h4 class="text-sm-center mt-2 mb-1 text-">
                        <strong>{{ $profile->title_before." ".$profile->first_name." ".$profile->middle_name." ".$profile->last_name." ".$profile->title_after }}</strong>
                    </h4>
                    <h4 class="text-sm-center mt-2 mb-1 text-muted">
                        @foreach(Auth::user()->roles as $r)
                            @if($r->id == 1)
                                <strong>{{__('main.superadmin')}} | </strong>
                            @elseif($r->id == 3)
                                <strong>{{__('main.admin')}} | </strong>
                            @elseif($r->id == 4)
                                <strong>{{__('main.reviewer')}} | </strong>
                            @endif
                        @endforeach
                        <strong>{{__('main.reguser')}}</strong>
                    </h4>
                </div>
            </div>
        </div>

    </div>

    <div class="col-sm-8">
        <div class="row animated fadeIn">
            @if($conference)
                <div class="col-sm-12" style="margin-bottom: 1em">
                    <a href="{{route('admin.conferences.show', $conference->id)}}" class="btn btn-outline-primary"
                       style="padding: 2em; border-width: 3px; width: 100%">
                        <h3>
                            {{$conference->title_sk}}<br>
                            {{$conference->year}}
                        </h3>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="{{route('admin.conferences.edit', $conference->id)}}" class="btn btn-outline-danger"
                       style="padding: 2em; border-width: 3px; width: 100%; height: 100%;">
                        <h4>
                            <i class="fa fa-cog fa-2x fa-spin"></i><br>
                            {{__('conference.settings')}}
                        </h4>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="#!" class="btn btn-outline-success"
                       style="padding: 2em; border-width: 3px; width: 100%; height: 100%;">
                        <h4>
                            <div class="fa-2x">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-users"></i>
                                    <span class="fa-layers-counter"
                                          style="background:Tomato">{{$stats['participants']}}</span>
                                </span>
                            </div>
                            {{__('stats.participants')}}
                        </h4>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="#!" class="btn btn-outline-info"
                       style="padding: 2em; border-width: 3px; width: 100%; height: 100%;">
                        <h4>
                            <div class="fa-2x">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-file"></i>
                                    <span class="fa-layers-counter"
                                          style="background:Tomato">{{$stats['contributions']}}</span>
                                </span>
                            </div>
                            {{__('stats.contributions')}}
                        </h4>
                    </a>
                </div>
            @endif
        </div>
    </div>

@endsection

@extends('backend.layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="col-sm-12 mb-4">
        <h4>Stats</h4>
        <div class="card-group">
            <div class="card col-lg-2 col-md-6 no-padding bg-flat-color-1">
                <div class="card-body">
                    <div class="h1 text-muted text-right mb-4">
                        <i class="fa fa-users text-light"></i>
                    </div>

                    <div class="h4 mb-0 text-light">
                        <span class="count">87500</span>
                    </div>
                    <small class="text-uppercase font-weight-bold text-light">Visitors</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
            <div class="card col-lg-2 col-md-6 no-padding no-shadow">
                <div class="card-body bg-flat-color-2">
                    <div class="h1 text-muted text-right mb-4">
                        <i class="fa fa-user-plus text-light"></i>
                    </div>
                    <div class="h4 mb-0 text-light">
                        <span class="count">385</span>
                    </div>
                    <small class="text-uppercase font-weight-bold text-light">New Clients</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
            <div class="card col-lg-2 col-md-6 no-padding no-shadow">
                <div class="card-body bg-flat-color-3">
                    <div class="h1 text-right mb-4">
                        <i class="fa fa-cart-plus text-light"></i>
                    </div>
                    <div class="h4 mb-0 text-light">
                        <span class="count">1238</span>
                    </div>
                    <small class="text-light text-uppercase font-weight-bold">Products sold</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
            <div class="card col-lg-2 col-md-6 no-padding no-shadow">
                <div class="card-body bg-flat-color-5">
                    <div class="h1 text-right text-light mb-4">
                        <i class="fa fa-pie-chart"></i>
                    </div>
                    <div class="h4 mb-0 text-light">
                        <span class="count">28</span>%
                    </div>
                    <small class="text-uppercase font-weight-bold text-light">Returning Visitors</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
            <div class="card col-lg-2 col-md-6 no-padding no-shadow">
                <div class="card-body bg-flat-color-4">
                    <div class="h1 text-light text-right mb-4">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="h4 mb-0 text-light">5:34:11</div>
                    <small class="text-light text-uppercase font-weight-bold">Avg. Time</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
            <div class="card col-lg-2 col-md-6 no-padding no-shadow">
                <div class="card-body bg-flat-color-1">
                    <div class="h1 text-light text-right mb-4">
                        <i class="fa fa-comments-o"></i>
                    </div>
                    <div class="h4 mb-0 text-light">
                        <span class="count">972</span>
                    </div>
                    <small class="text-light text-uppercase font-weight-bold">COMMENTS</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-sm-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <h4 class="col-sm-9"><i class="fa fa-user"></i> {{$profile->first_name." ".$profile->last_name}}</h4>
                    <a href="{{route('user.profile.show', $profile->user_id)}}" class="btn btn-primary pull-right col-sm-3 btn-sm"><i class="fa fa-chevron-circle-right"></i> Profil</a>
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
                             src="{!! asset('public/images/profiles/'.$profile->id.'/'.$profile->image) !!}"
                             alt="Profile picture" width="200">
                    @endif
                    <p></p>
                    <h4 class="text-sm-center mt-2 mb-1 text-">
                        <strong>{{ $profile->title_before." ".$profile->first_name." ".$profile->middle_name." ".$profile->last_name." ".$profile->title_after }}</strong>
                    </h4>
                    @if(Auth::user()->access_level >= 3)
                        <h4 class="text-sm-center mt-2 mb-1 text-muted">
                            <strong>Administrator</strong>
                        </h4>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div class="col-sm-8">
        <div class="row animated fadeIn">
            @if($conference)
                <div class="col-sm-12" style="margin-bottom: 1em">
                    <a href="{{route('admin.conferences.show', $conference->id)}}" class="btn btn-outline-primary" style="padding: 2em; border-width: 3px; width: 100%">
                        <h3>
                            {{$conference->title_sk}}<br>
                            {{$conference->year}}
                        </h3>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="{{route('admin.conferences.edit', $conference->id)}}" class="btn btn-outline-danger" style="padding: 2em; border-width: 3px; width: 100%; height: 100%;">
                        <h4>
                            <i class="fa fa-cog fa-2x fa-spin"></i><br>
                            Nastavenie
                        </h4>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="#!" class="btn btn-outline-success" style="padding: 2em; border-width: 3px; width: 100%; height: 100%;">
                        <h4>
                            <div class="fa-2x">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-users"></i>
                                    <span class="fa-layers-counter" style="background:Tomato">45</span>
                                </span>
                            </div>
                            Účastníci
                        </h4>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="#!" class="btn btn-outline-info" style="padding: 2em; border-width: 3px; width: 100%; height: 100%;">
                        <h4>
                            <div class="fa-2x">
                                <span class="fa-layers fa-fw">
                                    <i class="fa fa-file"></i>
                                    <span class="fa-layers-counter" style="background:Tomato">32</span>
                                </span>
                            </div>
                            Príspevky
                        </h4>
                    </a>
                </div>
            @endif
        </div>
    </div>

@endsection

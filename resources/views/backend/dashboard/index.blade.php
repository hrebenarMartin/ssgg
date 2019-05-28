@extends('backend.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="col-sm-12 mb-4 animated fadeIn">
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

    @if(!$profile->workplace)
        <div class="col-12 animated fadeIn">
            <section class="card">
                <div class="card-header bg-danger">
                    <span class="card-title text-light">{{ __('titles.profile_not_complete') }} ->
                        <b><a href="{{ route("user.profile.show", Auth::id()) }}"
                              class="btn btn-outline-light text-light">{{ __('b_menu.profile') }}</a></b>
                    </span>
                </div>
            </section>
        </div>
    @endif

    <div class="col-12 animated fadeIn">
        <aside class="profile-nav alt">
            <section class="card">
                <div class="card-header user-header alt bg-dark">
                    <div class="media">
                        <a href="{{ route('user.profile.show', $profile->user_id) }}">
                            @if(!$profile->image)
                                @if($profile->gender == 'M')
                                    <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;"
                                         src="{!! asset('images/placeholders/user_m.png') !!}"
                                         alt="Profile picture">
                                @elseif($profile->gender == 'F')
                                    <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;"
                                         src="{!! asset('images/placeholders/user_f.png') !!}"
                                         alt="Profile picture">
                                @else
                                    <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;"
                                         src="{!! asset('images/placeholders/user_o.png') !!}"
                                         alt="Profile picture">
                                @endif
                            @else
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;"
                                     src="{!! asset('public/images/profiles/'.$profile->user_id.'/'.$profile->image) !!}"
                                     alt="Profile picture">
                            @endif
                        </a>
                        <div class="media-body">
                            <h2 class="text-light display-6">{{$profile->first_name ." ".$profile->last_name}}</h2>
                            <p>@foreach(Auth::user()->roles as $r)
                                    @if($r->id == 1)
                                        <strong>{{__('main.superadmin')}} | </strong>
                                    @elseif($r->id == 3)
                                        <strong>{{__('main.admin')}} | </strong>
                                    @elseif($r->id == 4)
                                        <strong>{{__('main.reviewer')}} | </strong>
                                    @endif
                                @endforeach {{__('main.reguser')}}</p>
                        </div>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    @if(Auth::user()->roles()->whereIn('role_id', [3,1])->first()  and $conference)
                        <li class="list-group-item text-center bg-primary" style="margin:0; padding: 0;">
                            <a href="{{route('admin.conferences.show', $conference->id)}}" class="btn btn-primary"
                               style="padding: 1em 0; width: 100%">
                                <h3 class="text-light">
                                    {{$conference->title_sk}}<br>
                                    {{$conference->year}}
                                </h3>
                            </a>
                        </li>
                        <li class="list-group-item bg-primary">
                            <a href="{{route('admin.conferences.edit', $conference->id)}}" class="text-light">
                                <i class="fa fa-cog fa-spin fa-fw"></i> {{__('conference.settings')}}
                            </a>
                        </li>
                        <li class="list-group-item bg-primary">
                            <a href="{{route('admin.conferences.conference_participants', $conference->id)}}"
                               class="text-light">
                                <i class="fa fa-users fa-fw"></i> {{__('stats.participants')}}
                                <span class="badge badge-danger pull-right">{{$stats['participants']}}</span>
                            </a>
                        </li>
                        <li class="list-group-item bg-primary">
                            <a href="{{ route('admin.conferences.conference_contributions', $conference->id) }}" class="text-light">
                                <i class="fa fa-file fa-fw"></i> {{__('stats.contributions')}}
                                <span class="badge badge-danger pull-right">{{$stats['contributions']}}</span>
                            </a>
                        </li>
                        <li class="list-group-item bg-primary">
                            <a href="{{ route('admin.conferences.conference_statistics', $conference->id) }}"
                               class="text-light">
                                <i class="fa fa-info fa-fw"></i> {{__('b_menu.conf_stats')}}
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->roles()->where('role_id', 1)->first())
                        <li class="list-group-item bg-info">
                            <a href="{{ route('admin.cms.index') }}" class="text-light">
                                <i class="fa fa-wrench fa-fw"></i> CMS
                            </a>
                        </li>
                        <li class="list-group-item bg-info">
                            <a href="{{ route('admin.user.index') }}" class="text-light">
                                <i class="fa fa-users-cog fa-fw"></i> {{__('b_menu.users')}}
                                <span class="badge badge-danger pull-right">{{count(App\User::all())}}</span>
                            </a>
                        </li>
                        <li class="list-group-item bg-info">
                            <a href="{{ route("admin.email-queue.index") }}" class="text-light">
                                <i class="fa fa-envelope-open fa-fw"></i> {{__('b_menu.email_queue')}}
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->roles()->where('role_id', 4)->first())
                        <li class="list-group-item bg-flat-color-5">
                            <a href="{{ route("review.myReview.index") }}" class="text-light">
                                <i class="fa fa-certificate fa-fw"></i> {{__('b_menu.review')}}
                                <span class="badge badge-danger pull-right">{{count(Auth::user()->reviews)}}</span>
                            </a>
                        </li>
                    @endif
                    <li class="list-group-item">
                        <a href="{{ route('user.profile.show', $profile->user_id) }}">
                            <i class="fa fa-user-cog fa-fw"></i> {{ __('b_menu.profile') }}
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('user.myContribution.index') }}">
                            <i class="fa fa-file fa-fw"></i> {{ __('b_menu.user_contribution') }}
                        </a>
                    </li>
                    @if($conference)
                        <li class="list-group-item">
                            <a href="{{ route('user.application.index') }}">
                                <i class="fa fa-id-badge fa-fw"></i> {{ __('b_menu.user_application') }}
                            </a>
                        </li>
                    @endif
                </ul>

            </section>
        </aside>
    </div>

@endsection

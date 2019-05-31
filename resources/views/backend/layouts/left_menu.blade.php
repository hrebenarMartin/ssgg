<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ route('dashboard.index') }}"><img src="{{ asset('images/logo_sq.png') }}"
                                                                               alt="Logo"></a>
            <a class="navbar-brand hidden" href="{{ route('dashboard.index') }}"><img
                        src="{{ asset('images/s_logo_sq.png') }}" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route('dashboard.index') }}"> <i
                                class="menu-icon fa fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="active">
                    <a href="{{ route('index') }}"> <i class="menu-icon fa fa-cube"></i>SSGG</a>
                </li>
                @if(isset($is_conference))
                    <li class="active">
                        <a href="{{ route('conference.index') }}"> <i
                                    class="menu-icon fa fa-microphone"></i>{{ __('b_menu.conference') }}</a>
                    </li>
                @endif
                @if(Auth::user()->roles()->where('role_id', 1)->first())
                    <h3 class="menu-title">Admin</h3>
                    <li>
                        <a href="{{ route('admin.cms.index') }}"><i
                                    class="menu-icon fa fa-wrench"></i>{{ __('b_menu.cms') }}</a>
                    </li>

                    <li>
                        <a href="{{ route('admin.user.index') }}"> <i
                                    class="menu-icon fa fa-users-cog"></i>{{ __('b_menu.users') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.contributions.index') }}"> <i
                                    class="menu-icon fas fa-copy"></i>{{ __('b_menu.contributions') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.conferences.index') }}"> <i
                                    class="menu-icon fa fa-microphone"></i>{{ __('b_menu.conference_management') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.email-queue.index') }}"><i
                                    class="menu-icon fa fa-envelope"></i>{{ __('b_menu.email_queue') }}</a>
                    </li>
                @endif

                @if(isset($is_conference) and Auth::user()->roles()->where('role_id', 3)->first())
                    <h3 class="menu-title">{{__('main.conference_zone')}}</h3>
                    <li>
                        <a href="{{route('admin.conferences.show', $is_conference->id)}}"><i
                                    class="menu-icon fa fa-search"></i>{{__('b_menu.conf_detail')}}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.conferences.conference_participants', $is_conference->id) }}"><i
                                    class="menu-icon fa fa-user-friends"></i>{{__('b_menu.conf_participants')}}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.conferences.conference_contributions', $is_conference->id) }}"><i
                                    class="menu-icon far fa-copy"></i>{{__('b_menu.conf_contributions')}}</a>
                    </li>
                    <li>
                        <a href="{{route('admin.conferences.conference_statistics', $is_conference->id)}}"><i
                                    class="menu-icon fa fa-info-circle"></i>{{__('b_menu.conf_stats')}}</a>
                    </li>
                @endif


                @if(Auth::user()->roles()->where('role_id', 4)->first())
                    <h3 class="menu-title">{{__('main.review_zone')}}</h3>
                    <li>
                        <a href="{{ route('review.myReview.index') }}"><i
                                    class="menu-icon far fa-edit "></i>{{__('b_menu.review')}}</a>
                    </li>
                @endif

                <h3 class="menu-title">{{__('main.user_zone')}}</h3>
                <li>
                    <a href="{{ route('user.profile.show', Auth::id()) }}"> <i
                                class="menu-icon fa fa-id-card"></i>{{ __('b_menu.profile') }}</a>
                </li>
                <li>
                    <a href="{{ route('user.application.index') }}"> <i
                                class="menu-icon fa fa-id-badge"></i>{{ __('b_menu.user_application') }}</a>
                </li>
                <li>
                    <a href="{{ route('user.myContribution.index') }}"> <i
                                class="menu-icon fa fa-file"></i>{{ __('b_menu.user_contribution') }}</a>
                </li>
            </ul>
        </div>
    </nav>
</aside>



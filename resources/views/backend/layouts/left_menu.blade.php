<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ route('dashboard.index') }}"><img src="{{ asset('images/logo_sq.png') }}" alt="Logo"></a>
            <a class="navbar-brand hidden" href="{{ route('dashboard.index') }}"><img src="{{ asset('images/s_logo_sq.png') }}" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route('dashboard.index') }}"> <i class="menu-icon fa fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="active">
                    <a href="{{ route('index') }}"> <i class="menu-icon fa fa-cube"></i>SSGG</a>
                </li>
                <li class="active">
                    <a href="{{ route('index') }}"> <i class="menu-icon fa fa-microphone"></i>{{ __('b_menu.conference') }}</a>
                </li>

                <h3 class="menu-title">Admin</h3><!-- /.admin-title -->
                <li>
                    <a href="{{ route('admin.cms.index') }}"><i class="menu-icon fa fa-wrench"></i>{{ __('b_menu.cms') }}</a>
                </li>

                <li>
                    <a href="{{ route('admin.user.index') }}"> <i class="menu-icon fa fa-users-cog"></i>{{ __('b_menu.users') }}</a>
                </li>
                <li>
                    <a href="#!"> <i class="menu-icon fas fa-copy"></i>{{ __('b_menu.contributions') }}</a>
                </li>
                <li>
                    <a href="{{ route('admin.conferences.index') }}"> <i class="menu-icon fa fa-microphone"></i>{{ __('b_menu.conference_management') }}</a>
                </li>

                <h3 class="menu-title">{{__('main.zone')}}</h3><!-- /.menu-title -->
                <li>
                    <a href="{{ route('user.profile.show', Auth::id()) }}"> <i class="menu-icon fa fa-id-card"></i>{{ __('b_menu.profile') }}</a>
                </li>
                <li>
                    <a href="{{ route('user.myContribution.index') }}"> <i class="menu-icon fa fa-file"></i>{{ __('b_menu.user_contribution') }}</a>
                </li>
                <li>
                    <a href="{{ route('user.application.index') }}"> <i class="menu-icon fa fa-id-badge"></i>{{ __('b_menu.user_application') }}</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->
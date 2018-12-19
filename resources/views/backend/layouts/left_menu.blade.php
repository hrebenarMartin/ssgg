<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-menu"></i>
            </button>
            <a class="navbar-brand" href="{{ route('dashboard.index') }}"><img src="{{ asset('images/logo_sq.png') }}" alt="Logo"></a>
            <a class="navbar-brand hidden" href="{{ route('dashboard.index') }}"><img src="{{ asset('images/s_logo_sq.png') }}" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route('dashboard.index') }}"> <i class="menu-icon fa fa-tachometer"></i>Dashboard</a>
                </li>
                <li class="active">
                    <a href="{{ route('index') }}"> <i class="menu-icon fa fa-cube"></i>SSGG</a>
                </li>
                <li class="active">
                    <a href="{{ route('index') }}"> <i class="menu-icon fa fa-microphone"></i>{{ __('b_menu.conference') }}</a>
                </li>

                <h3 class="menu-title">Admin</h3><!-- /.admin-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>CMS</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-wrench"></i><a href="{{ route('dashboard.index') }}">{{ __('b_menu.cms_front_ssgg') }}</a></li>
                        <li><i class="fa fa-wrench"></i><a href="{{ route('dashboard.index') }}">{{ __('b_menu.cms_front_conference') }}</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('user.index') }}"> <i class="menu-icon fa fa-group"></i>{{ __('b_menu.users') }}</a>
                </li>
                <li>
                    <a href="widgets.html"> <i class="menu-icon fa fa-file-word-o"></i>{{ __('b_menu.contributions') }}</a>
                </li>

                <h3 class="menu-title">Menu</h3><!-- /.menu-title -->

                <li>
                    <a href="widgets.html"> <i class="menu-icon fa fa-id-card"></i>{{ __('b_menu.profile') }}</a>
                </li>
                <li>
                    <a href="widgets.html"> <i class="menu-icon fa fa-id-card"></i>{{ __('b_menu.user_contribution') }}</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->

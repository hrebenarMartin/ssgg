<header id="header" class="header">

    <div class="header-menu">

        <div class="col-sm-7">
            <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa-tasks"></i></a>
            <div class="header-left">
                <button class="search-trigger"><i class="fa fa-search"></i></button>
                <div class="form-inline">
                    <form class="search-form">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                        <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-5">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(!$user_data->image)
                        @if($user_data->gender == 'M')
                            <img class="user-avatar rounded-circle" src="{!! asset('images/placeholders/user_m.png') !!}" alt="User Avatar">
                        @elseif($user_data->gender == 'F')
                            <img class="user-avatar rounded-circle" src="{!! asset('images/placeholders/user_f.png') !!}" alt="User Avatar">
                        @else
                            <img class="user-avatar rounded-circle" src="{!! asset('images/placeholders/user_o.png') !!}" alt="User Avatar">
                        @endif
                    @else
                        <img class="user-avatar rounded-circle" src="{!! asset('public/images/profiles/'.$user_data->user_id.'/'.$user_data->image) !!}" alt="User Avatar">
                    @endif
                </a>
                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="{{ route('user.profile.show', Auth::id()) }}"><i class="fa fa-user"></i> {{ __('b_menu.profile') }}</a>
                    <a class="nav-link" href="#!"
                       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <i class="fa fa-power-off"></i> {{ __('main.logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            <div class="pull-right" style="padding-top: 5px; padding-right: 2em">
                <button class="btn btn-sm">{{ __('main.language_change') }}: </button>
                @if(App::isLocale('en'))
                    <a href="{{route('set_locale', 'sk')}}" class="btn btn-primary btn-sm" style="border-radius: 20%">SK</a>
                @else
                    <a href="{{route('set_locale', 'en')}}" class="btn btn-primary btn-sm" style="border-radius: 20%">EN</a>
                @endif
            </div>
        </div>
    </div>

</header>
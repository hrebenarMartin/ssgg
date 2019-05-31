<header class="header-global">
    <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
        <div class="container">
            <a class="navbar-brand mr-lg-5" href="{{route('index')}}">
                <img src="{{asset('images/logo_sq.png')}}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global"
                    aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar_global">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="{{route('index')}}">
                                <img src="{{asset('images/s_logo_sq.png')}}">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse"
                                    data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                    @foreach ($menu_items as $i)
                        <li class="nav-item dropdown text-center"
                            @if(url()->current() == url($i->route))style="background-color: rgba(255,255,255,.1); border-radius: 20px"@endif>
                            <a href="{{url($i->route)}}" class="nav-link" role="button">
                                @if(App::isLocale('en'))
                                    <span class="nav-link-inner--text">{{ $i->name_en }}</span>
                                @else
                                    <span class="nav-link-inner--text">{{ $i->name_sk }}</span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                    @if(isset($conference) and $module == 1)
                        <li class="nav-item dropdown">
                            <a href="{{route('conference.index')}}" class="nav-link" role="button">
                                <span
                                        class="nav-link-inner--text">{{ __('main.conference', ['year' => $conference->year]) }}</span>
                            </a>
                        </li>
                    @endif
                </ul>
                <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                    @if(App::isLocale('en'))
                        <li>
                            <a href="{{route('set_locale', 'sk')}}" class="btn btn-neutral btn-sm btn-icon">
                                <span class="btn-inner--icon">SK</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{route('set_locale', 'en')}}" class="btn btn-neutral btn-sm btn-icon">
                                <span class="btn-inner--icon">EN</span>
                            </a>
                        </li>
                    @endif

                    @if($user)
                        <li class="nav-item d-none d-lg-block ml-lg-4 dropdown">
                            <button type="button" class="btn btn-neutral" data-toggle="dropdown" data-target="#f_menu"
                                    role="button">
                                <span class="nav-link-inner--text text-primary">Menu</span>
                            </button>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown" role="button">
                                @if($user->profile->image)
                                    <img src="{{asset('public/images/profiles/'.$user->id."/".$user->profile->image)}}"
                                         class="rounded-circle" width="50">
                                @else
                                    @if($user->profile->gender == 'M')
                                        <img class="rounded-circle"
                                             src="{!! asset('images/placeholders/user_m.png') !!}"
                                             alt="Profile picture" width="50">
                                    @elseif($user->profile->gender == 'F')
                                        <img class="rounded-circle"
                                             src="{!! asset('images/placeholders/user_f.png') !!}"
                                             alt="Profile picture" width="50">
                                    @else
                                        <img class="rounded-circle"
                                             src="{!! asset('images/placeholders/user_o.png') !!}"
                                             alt="Profile picture" width="50">
                                    @endif
                                @endif
                            </a>
                            <div class="dropdown-menu" id="f_menu">
                                <div class="dropdown-menu-inner">
                                    <a href="{{ route("dashboard.index") }}" class="dropdown-item">
                                        <div class="media-body">
                                            <button type="button" class="btn btn-primary btn-icon" style="width: 100%">
                                                <span class="nav-link-inner--text">{{__('form.action_dashboard')}}</span>
                                            </button>
                                        </div>
                                    </a>
                                    <a href="{{ route("user.profile.show", Auth::id()) }}" class="dropdown-item">
                                        <div class="media-body">
                                            <button type="button" class="btn btn-neutral btn-sm" style="width: 100%">
                                                <span class="nav-link-inner--text">{{__('b_menu.profile')}}</span>
                                            </button>
                                        </div>
                                    </a>
                                    <a href="#!" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" target="_blank"
                                       class="dropdown-item">
                                        <div class="media-body">
                                            <button type="button" class="btn btn-danger btn-sm" style="width: 100%">
                                                <span class="nav-link-inner--text">{{__('main.logout')}}</span>
                                            </button>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <li class="nav-item d-none d-lg-block ml-lg-4">
                            <a href="{{route('login')}}" class="btn btn-neutral btn-icon">
                                <span class="nav-link-inner--text">{{__('main.login')}}</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </nav>
</header>

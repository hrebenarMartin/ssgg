<header class="header-global">
    <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
        <div class="container">
            <a class="navbar-brand mr-lg-5" href="{{route('index')}}">
                <img src="{{asset('images/logo_sq.png')}}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
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
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                    @foreach ($menu_items as $i)
                        <li class="nav-item dropdown">
                            <a href="{{url($i->route)}}" class="nav-link" role="button">
                                @if(App::isLocale('en'))
                                    <span class="nav-link-inner--text">{{ $i->name_en }}</span>
                                @else
                                    <span class="nav-link-inner--text">{{ $i->name_sk }}</span>
                                @endif
                            </a>
                        </li>
                    @endforeach

                    @if($conference->is == 1)
                        <li class="nav-item dropdown">
                            <a href="{{route('conference.show', $conference->year)}}" class="nav-link" role="button">
                                <span class="nav-link-inner--text">{{ __('main.conference', ['year' => $conference->year]) }}</span>
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
                        <li class="nav-item d-none d-lg-block ml-lg-4">
                            <a href="#!" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" target="_blank" class="btn btn-neutral btn-icon">
                                <span class="nav-link-inner--text">{{__('main.logout')}}</span>
                            </a>
                        </li>
                        <li>
                            <img src="{{asset('public/images/profiles/'.$user->id."/".$user->profile->image)}}" class="rounded-circle" width="50">
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

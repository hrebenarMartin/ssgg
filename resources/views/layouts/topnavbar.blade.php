<nav class="navbar navbar-expand-md navbar-laravel w3-theme-d3" id="navbar">
    <div class="container">
        <a class="navbar-brand w3-bottombar  color-border-green" href="{{ url('/') }}">
            {{ config('app.name', 'SSGG') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link w3-bottombar w3-border-theme-d3 color-hover-border-green" href="{{ route('index') }}">{{__('Home')}}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link w3-bottombar w3-border-theme-d3 color-hover-border-green" href="{{ route('show', 'contact') }}">{{__('Contact')}}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link w3-bottombar w3-border-theme-d3 color-hover-border-green" href="{{ route('show', 'about') }}">{{__('About')}}</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link w3-bottombar w3-border-theme-d3 color-hover-border-green" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link w3-bottombar w3-border-theme-d3 color-hover-border-green" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

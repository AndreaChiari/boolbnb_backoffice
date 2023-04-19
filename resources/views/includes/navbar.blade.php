<nav class="navbar navbar-expand-md d-flex align-items-center shadow-sm">
    <div class="container">
        <nav class="d-flex align-items-center justify-content-between d-md-none w-100">
            <a class="nav-link logo logo-test d-flex align-items-center" href="{{ url('http://localhost:5174/') }}"><img
                    src="/boolbnb_2.png" alt="logo" class="logo logo-small img-fluid">
                <a class="nav-link @if (request()->routeIs('admin.apartments*')) active @endif"
                    href="{{ route('admin.apartments.index') }}">Appartamenti</a>
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-regular fa-user"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right collapsed" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profilo') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
        </nav>
        <a class="navbar-brand d-none align-items-center" href="{{ url('/') }}">
            <div class="boolbnb_laravel">

            </div>
            {{-- config('app.name', 'Laravel') --}}
        </a>

        <button class="navbar-toggler d-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="{{ __('Toggle navigation') }}">
            <span class="d-none navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav test-dio d-flex align-items-center me-auto justify-content-sm-center flex-row ">
                <li class="nav-item me-md-2 d-flex justify-items-center">
                    <a class="nav-link logo logo-test d-flex align-items-center"
                        href="{{ url('http://localhost:5174/') }}"><img src="/boolbnb_2.png" alt="logo"
                            class="logo img-fluid">
                        <p class="mt-3 d-none d-md-block">OOLBNB<p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if (request()->routeIs('admin.apartments*')) active @endif"
                        href="{{ route('admin.apartments.index') }}">{{ __('Appartamenti') }}</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profilo') }}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

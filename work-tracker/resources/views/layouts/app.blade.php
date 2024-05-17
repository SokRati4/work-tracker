<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('styles')

    <style>
    .img-size{
        width: 30px;
        height: auto
    }
    </style>

    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container p-1">
                <a class="navbar-brand" href="{{ url('/home') }}" style="color: #16C7AA;">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    Work tracker
                </a>
                <div>
                    <img src="{{ asset('icon/icon.png') }}" alt="Logo" class="img-fluid img-size">
                </div>
                <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                            @if(Auth::check())
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Menu
                                </a>
                                @if (Auth::user()->role == 1)
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/home') }}">Strona główna</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Moja praca</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Wiadomości</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Moje urlopy</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Wnioski urlopowe</a>
                                </div>
                                @endif

                                @if (Auth::user()->role == 2 || Auth::user()->role == 3)
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/home') }}">Strona główna</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Lista pracowników</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Zarządzanie kontami</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Zatrudnienia</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Wiadomości</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Urlopy</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Moja praca</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Moje urlopy</a>
                                </div>
                                @endif
                            </li>
                            @endif 
                    </ul>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->login }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

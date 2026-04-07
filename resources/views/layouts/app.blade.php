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
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app" class="d-flex flex-column flex-grow-1">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('f1.dashboard') ? 'active' : '' }}" href="{{ route('f1.dashboard') }}">🏎️ F1 Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="f1Dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                F1 Stats
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="f1Dropdown">
                                <li><a class="dropdown-item {{ request()->routeIs('f1.drivers') ? 'active' : '' }}" href="{{ route('f1.drivers') }}">Drivers</a></li>
                                <li><a class="dropdown-item {{ request()->routeIs('f1.teams') ? 'active' : '' }}" href="{{ route('f1.teams') }}">Teams</a></li>
                                <li><a class="dropdown-item {{ request()->routeIs('f1.circuits') ? 'active' : '' }}" href="{{ route('f1.circuits') }}">Circuits</a></li>
                                <li><a class="dropdown-item {{ request()->routeIs('f1.seasons') ? 'active' : '' }}" href="{{ route('f1.seasons') }}">Seasons</a></li>
                            </ul>
                        </li>
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
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->is_admin)
                                        <a class="dropdown-item" href="{{ route('admin.index') }}">{{ __('Admin Dashboard') }}</a>
                                    @endif

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

        <main class="flex-grow-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-dark text-white mt-auto">
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5 class="fw-bold mb-3">{{ config('app.name', 'F1 Stats Hub') }}</h5>
                        <p class="text-muted">Your ultimate destination for Formula 1 statistics, driver standings, team performance, and race results.</p>
                    </div>
                    <div class="col-md-2 mb-4 mb-md-0">
                        <h6 class="fw-bold mb-3">F1 Stats</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ route('f1.dashboard') }}" class="text-muted text-decoration-none">Dashboard</a></li>
                            <li class="mb-2"><a href="{{ route('f1.drivers') }}" class="text-muted text-decoration-none">Drivers</a></li>
                            <li class="mb-2"><a href="{{ route('f1.teams') }}" class="text-muted text-decoration-none">Teams</a></li>
                            <li class="mb-2"><a href="{{ route('f1.circuits') }}" class="text-muted text-decoration-none">Circuits</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 mb-4 mb-md-0">
                        <h6 class="fw-bold mb-3">Resources</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="https://laravel.com/docs" target="_blank" class="text-muted text-decoration-none">Documentation</a></li>
                            <li class="mb-2"><a href="https://github.com" target="_blank" class="text-muted text-decoration-none">GitHub</a></li>
                            <li class="mb-2"><a href="https://laracasts.com" target="_blank" class="text-muted text-decoration-none">Laracasts</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h6 class="fw-bold mb-3">Connect</h6>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-muted"><i class="bi bi-twitter fs-4"></i></a>
                            <a href="#" class="text-muted"><i class="bi bi-github fs-4"></i></a>
                            <a href="#" class="text-muted"><i class="bi bi-linkedin fs-4"></i></a>
                            <a href="#" class="text-muted"><i class="bi bi-envelope fs-4"></i></a>
                        </div>
                    </div>
                </div>
                <hr class="my-4 border-secondary">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                        <p class="text-muted mb-0">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel Blog') }}. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="text-muted mb-0">Built with <i class="bi bi-heart-fill text-danger"></i> using Laravel</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>

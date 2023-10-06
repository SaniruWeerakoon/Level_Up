<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LevelUp') }}</title>
    {{-- //favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/favicon/browserconfig.xml">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- <link href="/css/appblade.css" rel="stylesheet"> --}}
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/appblade.css'])
    @livewireStyles
</head>

<body class="body" style="display: flex; flex-direction: column; min-height: 100vh;">
    <div id="app" style="flex: 1;">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'LevelUp') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('courses.index') }}">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Quizzes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tutorials</a>
                        </li>
                        {{-- //conevrt --}}
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('enrollments.index') }}">My Courses</a>
                            </li>
                        @endauth


                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item m-2 bg-primary rounded">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }} &nbsp;&nbsp;<i
                                            class="fas fa-sign-in-alt"></i></a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item  m-2 bg-primary rounded">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }} &nbsp;&nbsp;<i
                                            class="fas fa-user-plus"></i></a>
                                </li>
                            @endif
                        @else
                            {{-- <a href="{{ url('/profile') }}"
                                class="m-1 bg-primary text-white font-weight-bold rounded px-3 py-2 "
                                style="color:aliceblue">Profile &nbsp;&nbsp;<i class="fas fa-user"></i></a> --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        {{ __('Profile') }}
                                    </a>
                            
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

        <main class="py-4 ">
            @yield('content')
        </main>
    </div>
    <footer class="d-flex bg-dark  flex-wrap justify-content-between align-items-center py-2 mt-5 border-top"
        style="flex-shrink: 0;">
        <p class="col-md-4 ml-3 text-white mb-0 px-3 ">
            © 2023 LevelUp, Inc
        </p>

        <a href="/"
            class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="/images/logo_transparent.png" alt="logo" width="80px" height="100px" />
        </a>

        <ul class="nav  col-md-4 justify-content-end">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link px-2  ">Home</a>
            </li>3
            <li class="nav-item">
                <a href="{{ route('courses.index') }}" class="nav-link px-2 ">Courses</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link px-2 ">Quizzes</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link px-2 ">About Us</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link px-2 ">FAQ</a>
            </li>
        </ul>
    </footer>
    @livewireScripts
</body>


</html>

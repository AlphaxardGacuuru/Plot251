<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Change address bar color Chrome, Firefox OS and Opera --}}
    <meta name="theme-color" content="#232323" />
    {{-- iOS Safari --}}
    <meta name="apple-mobile-web-app-status-bar-style" content="#232323">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Plot251') }}</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/p-512x512.png">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }

    </style>

    {{-- IOS support --}}
    <link rel="apple-touch-icon" href="img/musical-note.png">
    <meta name="apple-mobile-web-app-status-bar" content="#aa7700">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                @auth
                    @if(Auth::user()->name == "Admin")
                        <a style="color: #209CEE;" class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Plot251') }}
                        </a>
                    @endif
                @endauth
                {{-- <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
                </button> --}}

                {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> --}}
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if(Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right rounded-0 p-0"
                                aria-labelledby="navbarDropdown">
                                @auth
                                    @if(Auth::user()->name == "Admin")
                                        <a class="dropdown-item" href="/water-readings/create">Add readings</a>
                                        <a class="dropdown-item" href="/water-payments/create">Add payments</a>
                                        <a class="dropdown-item" href="/apartment/0">My Account</a>
                                    @endif
                                @endauth
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
                {{-- </div> --}}
            </div>
        </nav>
        <br>

        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <br>
                <br>
                @include('inc/messages')
            </div>
            <div class="col-sm-4"></div>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>

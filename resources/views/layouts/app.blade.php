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
    <link rel="icon" href="/favicon-32x32.png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    {{-- Manifest --}}
    <link rel="manifest" type="application/manifest+json" href="/manifest.webmanifest">

    {{-- IOS support --}}
    <link rel="apple-touch-icon" href="storage/img/favicon-32x32.png">
    <meta name="apple-mobile-web-app-status-bar" content="#aa7700">
</head>

<body>
    <div id="app" style="overflow-x: hidden;">

        @include('inc/header')

        <main class="py-4 px-2">
			<br>
			
            @include('inc/messages')

            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
</body>

</html>

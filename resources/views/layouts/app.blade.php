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
	<link rel="icon" href="/storage/img/favicon-32x32.png">

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
		<!-- ***** Header Area Start ***** -->
		<header style="background-color: #232323" class="header-area">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="menu-area d-flex justify-content-between">
							<!-- Logo Area  -->
							<div class="logo-area">
								@auth
								@if(Auth::user()->name == "Admin")
								<a href="/">Plot 251</a>
								@endif
								@else
								<a href="#">Plot 251</a>
								@endauth
							</div>

							<div class="menu-content-area d-flex align-items-center">
								<!-- Header Social Area -->
								<div class="header-social-area d-flex align-items-center">
									<!-- Authentication Links -->
									@guest
									<li class="nav-item">
										<a class="display-4" href="{{ route('login') }}">{{ __('Login') }}</a>
									</li>
									{{-- @if(Route::has('register'))
                                            <li class="nav-item">
                                                <a class="display-4"
                                                    href="{{ route('register') }}">{{ __('Register') }}</a>
									</li>
									@endif --}}
									@else
									<div class="dropdown">
										<a href="#" class="nav-link dropdown-toggle" role="button" id="dropdownMenuLink"
											data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											{{ Auth::user()->name }}
										</a>
										<div style="border-radius: 0;" class="dropdown-menu dropdown-menu-right m-0 p-0"
											aria-labelledby="dropdownMenuButton">
											@if (Auth::user()->name == "Admin")
											<a href='/water-readings/create' class="p-3 dropdown-item border-bottom">
												<h6>Readings</h6>
											</a>
											<a href="/water-payments/create" class="p-3 dropdown-item border-bottom">
												<h6>Payments</h6>
											</a>
											<a href="/sms" class="p-3 dropdown-item border-bottom">
												<h6>SMS</h6>
											</a>
											@else
											<a href="/apartment/0" class="p-3 dropdown-item border-bottom">
												<h6>My Account</h6>
											</a>
											@endif
											<a href="{{ route('logout') }}" class="p-3 dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
												<h6>{{ __('Sign out') }}</h6>
											</a>
											<form id="logout-form" action="{{ route('logout') }}" method="POST"
												style="display: none;">
												@csrf
											</form>
										</div>
									</div>
									@endguest
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- ***** Header Area End ***** -->
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

		<main class="py-4 px-2">
			@yield('content')
		</main>
	</div>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script src="{{ asset('js/custom.js') }}" defer></script>
</body>

</html>
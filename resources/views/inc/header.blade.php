<!-- ***** Header Area Start ***** -->
<header class="header-area bg-primary">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="menu-area d-flex justify-content-between">
                    <!-- Logo Area  -->
                    <div class="logo-area">
                        @auth
                            <a href="/"
                               style="font-size: 2rem;">Plot 251</a>
                        @else
                            <a href="#">Plot 251</a>
                        @endauth
                    </div>

                    <div class="menu-content-area d-flex align-items-center">
                        <!-- Header Social Area -->
                        <div class="header-social-area d-flex align-items-center">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item"
                                    style="list-style-type: none;">
                                    <a class="display-4"
                                       href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                {{-- @if(Route::has('register'))
                                    <li class="nav-item"
                                        style="list-style-type: none;">
                                        <a class="display-4"
                                           href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif--}}
                        @else
                            <div class="dropdown hidden">
                                <a href="#"
                                   class="nav-link dropdown-toggle"
                                   role="button"
                                   id="dropdownMenuLink"
                                   data-toggle="dropdown"
                                   aria-haspopup="true"
                                   aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <div style="border-radius: 0;"
                                     class="dropdown-menu dropdown-menu-right m-0 p-0"
                                     aria-labelledby="dropdownMenuButton">
                                    @if(Auth::user()->name ==
                                        "Admin")
                                        <a href='/apartments'
                                           class="p-3 dropdown-item border-bottom">
                                            <h6>Accounts</h6>
                                        </a>
                                        <a href='/water-readings/create'
                                           class="p-3 dropdown-item border-bottom">
                                            <h6>Readings</h6>
                                        </a>
                                        <a href="/water-payments/create"
                                           class="p-3 dropdown-item border-bottom">
                                            <h6>Payments</h6>
                                        </a>
                                        <a href="/sms"
                                           class="p-3 dropdown-item border-bottom">
                                            <h6>SMS</h6>
                                        </a>
                                    @endif
                                    <a href="{{ route('logout') }}"
                                       class="p-3 dropdown-item"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <h6>{{ __('Log out') }}</h6>
                                    </a>
                                    <form id="logout-form"
                                          action="{{ route('logout') }}"
                                          method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            {{-- For small screens --}}
                            <div class="text-light anti-hidden"
                                 onclick="document.getElementById('bottom-menu').classList.add('menu-open')">
                                <a href="#"
                                   onclick="event.preventDefault()">
                                    {{ Auth::user()->name }}
                                </a>
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

{{-- {/* Sliding Bottom Nav */} --}}
<div id="bottom-menu">
    <div class="bottomMenu">
        <div class="d-flex align-items-center justify-content-between">
            <div></div>
            {{-- {/* <!-- Close Icon --> */} --}}
            <div class="closeIcon text-dark float-right"
                 onclick="document.getElementById('bottom-menu').classList.remove('menu-open')">
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="1.2em"
                     height="1.2em"
                     fill="currentColor"
                     class="bi bi-x"
                     viewBox="0 0 16 16">
                    <path
                          d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </div>
        </div>

        {{-- {/* Avatar Bottom */} --}}
        <div class="m-0 p-0">
            @if(Auth::user()->name ==
                "Admin")
                <a href='/apartments'
                   class="pb-2">
                    <h6><span class="ml-3 mr-4">Accounts</span></h6>
                </a>
                <a href='/water-readings/create'
                   class="pb-2">
                    <h6><span class="ml-3 mr-4">Readings</span></h6>
                </a>
                <a href="/water-payments/create"
                   class="pb-2">
                    <h6><span class="ml-3 mr-4">Payments</span></h6>
                </a>
                <a href="/sms"
                   class="pb-2">
                    <h6><span class="ml-3 mr-4">SMS</span></h6>
                </a>
            @endif
            <a href="{{ route('logout') }}"
               class="dropdown-item"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <h6><span class="ml-3 mr-4">{{ __('Log out') }}</span></h6>
            </a>
            <form id="logout-form"
                  action="{{ route('logout') }}"
                  method="POST"
                  style="display: none;">
                @csrf
            </form>
        </div>
        {{-- {/* Avatar Bottom End */} --}}
    </div>
</div>
{{-- {/* Sliding Bottom Nav End */} --}}

<!-- ***** Header Area Start ***** -->
<header class="header-area"
        style="background-color: #fff">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="menu-area d-flex justify-content-between">
                    <!-- Logo Area  -->
                    <div class="logo-area">
                        @auth
                            <a href="/"
                               class="text-dark"
                               style="font-size: 2rem;">Black Property</a>
                        @else
                            <a href="#"
                               class="text-dark"
                               style="font-size: 2rem;">Black Property</a>
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
                                   class="nav-link dropdown-toggle text-dark"
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
                            <div class="text-dark anti-hidden"
                                 onclick="document.getElementById('bottom-menu').classList.add('menu-open')">
                                <a href="#"
                                   class="text-dark"
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
            @guest
            @else
                @if(Auth::user()->name ==
                    "Admin")
                    <a href='/apartments'
                       class="p-2 text-left">
                        <h6>
                            <span class="ml-3 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="16"
                                     height="16"
                                     fill="currentColor"
                                     class="bi bi-people"
                                     viewBox="0 0 16 16">
                                    <path
                                          d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                                </svg>
                            </span>
                            Accounts
                        </h6>
                    </a>
                    <a href='/water-readings/create'
                       class="p-2 text-left">
                        <h6>
                            <span class="ml-3 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="16"
                                     height="16"
                                     fill="currentColor"
                                     class="bi bi-files"
                                     viewBox="0 0 16 16">
                                    <path
                                          d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z" />
                                </svg>
                            </span>
                            Readings
                        </h6>
                    </a>
                    <a href="/water-payments/create"
                       class="p-2 text-left">
                        <h6>
                            <span class="ml-3 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="16"
                                     height="16"
                                     fill="currentColor"
                                     class="bi bi-wallet2"
                                     viewBox="0 0 16 16">
                                    <path
                                          d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
                                </svg>
                            </span>
                            Payments
                        </h6>
                    </a>
                    <a href="/sms"
                       class="p-2 text-left">
                        <h6>
                            <span class="ml-3 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="16"
                                     height="16"
                                     fill="currentColor"
                                     class="bi bi-chat-left-text"
                                     viewBox="0 0 16 16">
                                    <path
                                          d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    <path
                                          d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </span>
                            SMS
                        </h6>
                    </a>
                @endif
                <a href="{{ route('logout') }}"
                   class="text-left"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <h6>
                        <span class="ml-3 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="16"
                                 height="16"
                                 fill="currentColor"
                                 class="bi bi-box-arrow-right"
                                 viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                <path fill-rule="evenodd"
                                      d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                            </svg>
                        </span>
                        {{ __('Log out') }}
                    </h6>
                </a>
                <form id="logout-form"
                      action="{{ route('logout') }}"
                      method="POST"
                      style="display: none;">
                    @csrf
                </form>
            @endguest
        </div>
        {{-- {/* Avatar Bottom End */} --}}
    </div>
</div>
{{-- {/* Sliding Bottom Nav End */} --}}

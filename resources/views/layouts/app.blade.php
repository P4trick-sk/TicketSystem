<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">

        <header>
            <div id="horizontal" class="topnav">
                <img src="{{ asset('img/logo.png') }}" alt="logo" id="logo" />
                <div class="searchbar">
                    <svg viewBox="0 0 24 24" aria-hidden="true" class="icon">
                        <g>
                            <path
                                d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"
                            ></path>
                        </g>
                    </svg>
                    <input class="input" type="search" placeholder="Hľadať..." />
                </div>
                <a href="{{ route('tickets.create') }}">
                  <span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        width="24"
                        height="24"
                    >
                      <path fill="none" d="M0 0h24v24H0z"></path>
                      <path
                          fill="currentColor"
                          d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"
                      ></path>
                    </svg>
                    Vytvoriť
                  </span>
                </a>
                <img
                    id="top_icons"
                    class="change_color"
                    src="{{ asset('icons/nav/question-circle.svg') }}"
                    alt="question-circle"
                />
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link style="background: rgb(31 41 55 / var(--tw-bg-opacity))" :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if(Auth::user()->isAdmin())
                                <x-dropdown-link style="background: rgb(31 41 55 / var(--tw-bg-opacity))" :href="route('admin.index')">
                                    {{ __('Administracia') }}
                                </x-dropdown-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link style="background: rgb(31 41 55 / var(--tw-bg-opacity))" :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Odhlásiť') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </header>
        <div class="content">
            <nav id="vertical">
                <div class="upper_icons">
                    <img
                        id="upper_icons"
                        class="change_color"
                        src="{{ asset('icons/sidebar/home.svg') }}"
                        alt="home"
                    />
                    <img
                        id="upper_icons"
                        class="change_color"
                        src="{{ asset('icons/sidebar/envelope.svg') }}"
                        alt="envelope"
                    />
                    <img
                        id="upper_icons"
                        class="change_color"
                        src="{{ asset('icons/sidebar/bar-chart.svg') }}"
                        alt="bar-chart"
                    />
                    <img
                        id="upper_icons"
                        class="change_color"
                        src="{{ asset('icons/sidebar/calendar.svg') }}"
                        alt="calendar"
                    />
                    <img
                        id="upper_icons"
                        class="change_color"
                        src="{{ asset('icons/sidebar/star-fill.svg') }}"
                        alt="star-fill"
                    />
                </div>
                <div class="lower_icons">
                    <label class="switch">
                        <span class="sun"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="#ffd43b"><circle r="5" cy="12" cx="12"></circle><path d="m21 13h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2zm-17 0h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2zm13.66-5.66a1 1 0 0 1 -.66-.29 1 1 0 0 1 0-1.41l.71-.71a1 1 0 1 1 1.41 1.41l-.71.71a1 1 0 0 1 -.75.29zm-12.02 12.02a1 1 0 0 1 -.71-.29 1 1 0 0 1 0-1.41l.71-.66a1 1 0 0 1 1.41 1.41l-.71.71a1 1 0 0 1 -.7.24zm6.36-14.36a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1zm0 17a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1zm-5.66-14.66a1 1 0 0 1 -.7-.29l-.71-.71a1 1 0 0 1 1.41-1.41l.71.71a1 1 0 0 1 0 1.41 1 1 0 0 1 -.71.29zm12.02 12.02a1 1 0 0 1 -.7-.29l-.66-.71a1 1 0 0 1 1.36-1.36l.71.71a1 1 0 0 1 0 1.41 1 1 0 0 1 -.71.24z"></path></g></svg></span>
                        <span class="moon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="m223.5 32c-123.5 0-223.5 100.3-223.5 224s100 224 223.5 224c60.6 0 115.5-24.2 155.8-63.4 5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6-96.9 0-175.5-78.8-175.5-176 0-65.8 36-123.1 89.3-153.3 6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"></path></svg></span>
                        <input type="checkbox" class="input">
                        <span class="slider"></span>
                    </label>
                    <button onclick="myFunction()" class="showhide">
                        <span> Hide </span>
                    </button>
                    <img
                        class="change_color"
                        src="{{ asset('icons/sidebar/cog.svg') }}"
                        alt="cog"
                    />
                </div>
            </nav>
            <div id="mySIDEBAR" class="sidebar">
                <button class="drop_button">
                    <p>Zobrazenie ticketov</p>
                    <div class="icon">
                        <svg
                            height="24"
                            width="24"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                fill="currentColor"
                            ></path>
                        </svg>
                    </div>
                </button>
                <a href="{{ route('tickets.index.created') }}" class="drop_button_menu">
                    <p>Moje tickety</p>
                    <div class="icon">
                        {{ \App\Models\Ticket::where('created_by', Auth::user()->id)->count() }}
                    </div>
                </a>
                @if(Auth::user()->isTeacher())
                <a href="{{ route('tickets.index.assigned') }}" class="drop_button_menu">
                    <p>Mne pridelené tickety</p>
                    <div class="icon">
                        {{ \App\Models\Ticket::where('assigned_to', Auth::user()->id)->count() }}
                    </div>
                </a>
                @endif
                {{--<button class="drop_button_menu">
                    <p>S vysokou prioritou</p>
                    <div class="icon">
                        13
                    </div>
                </button>
                <button class="drop_button_menu">
                    <p>Všetky tickety</p>
                    <div class="icon">
                        1439
                    </div>
                </button>--}}
            </div>
            <div class="main">
                <div class="filter">
                    <img
                        id="filter_icons"
                        src="{{ asset('icons/filter/check-box.svg') }}"
                        alt="check-box"
                    />
                    <img
                        id="filter_icons"
                        src="{{ asset('icons/filter/reply.svg') }}"
                        alt="reply"
                    />
                    <img
                        id="filter_icons"
                        src="{{ asset('icons/filter/trash-can.svg') }}"
                        alt="trash-can"
                    />
                </div>
                <main id="main">
                    <div id="main-nano-wrapper" class="nano">
                        <div class="nano-content">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
        </div>

        <script>
            function myFunction() {
                var x = document.getElementById("mySIDEBAR");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>
    </body>
</html>

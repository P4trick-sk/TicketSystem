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
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Intro.js -->
        <link rel="stylesheet" href="https://unpkg.com/intro.js/introjs.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased body-container">

        <header data-intro="Toto je vrchný navigačný panel. Nájdete tu logo našej aplikácie, prihláseného používateľa a možnosť vytvoriť ticket." data-step="2">
            <div id="horizontal" class="topnav">
                <img src="{{ asset('img/logo.png') }}" alt="logo" id="logo" />
                {{--<div class="searchbar">
                    <svg viewBox="0 0 24 24" aria-hidden="true" class="icon">
                        <g>
                            <path
                                d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"
                            ></path>
                        </g>
                    </svg>
                    <input class="input" type="search" placeholder="Hľadať..." />
                </div>--}}
                <div class="d-flex">
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        @if (request()->routeIs('tickets.index.created'))
                        <img
                            id="top_icons"
                            class="change_color"
                            src="{{ asset('icons/nav/question-circle.svg') }}"
                            alt="question-circle"
                        />
                        @else
                        <a href="{{ route('tickets.index.created') }}">                        
                            <img
                            class="change_color"
                            src="{{ asset('icons/nav/question-circle.svg') }}"
                            alt="question-circle"
                            />
                        </a>
                        @endif
                        <x-dropdown class="jankohrasko" align="right" width="48">
                            <x-slot name="trigger">
                                <button class="dropdown-button inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150">
                                    <div class="d-flex">
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
                                    <span>
                                        Vytvoriť
                                      </span>
                                    </div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link class="dropdown-link" :href="route('tickets.create')">
                                    {{ __('Ticket') }}
                                </x-dropdown-link>

                                @if(Auth::user()->isTeacher())
                                <x-dropdown-link class="dropdown-link" :href="route('groups.create')">
                                    {{ __('Skupinu ticketov') }}
                                </x-dropdown-link>
                                @endif
                            </x-slot>
                        </x-dropdown>
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="dropdown-button inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @if(Auth::user()->isAdmin())
                                    <x-dropdown-link class="dropdown-link" :href="route('admin.index')">
                                        {{ __('Administracia') }}
                                    </x-dropdown-link>
                                @endif

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link class="dropdown-link" :href="route('logout')"
                                                     onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Odhlásiť') }}
                                    </x-dropdown-link>
                                </form>
                                <p class="notif-title">Notifikácie</p>
                                @foreach(Auth::user()->notifications()->take(4)->get() as $notification)
                                        <x-dropdown-link class="dropdown-notif" :href="$notification->data['url']">
                                            {{ $notification->data['message'] }}
                                        </x-dropdown-link>
                                @endforeach
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>
        </header>
        <div class="content" data-title="Vitajte!" data-intro="Práve sa nachádzate v používateľskom rozhraní!" data-step="1">
            <nav id="vertical" data-intro="Toto je bočný navigačný panel. Nájdete tu výber ticketov spolu s nastaveniami a tlačítkom pre skrytie bočného panelu." data-step="3">
                <div class="upper_icons">
                    <a href="{{ route('tickets.index.created') }}">
                    <img
                        id="upper_icons"
                        class="change_color"
                        src="{{ asset('icons/sidebar/ticket.svg') }}"
                        alt="ticket"
                    />
                    </a>
                    @if(Auth::user()->isTeacher())
                        <a href="{{ route('groups.index') }}">
                            <img
                                id="upper_icons"
                                class="change_color"
                                src="{{ asset('icons/sidebar/folder.svg') }}"
                                alt="folder"
                            />
                        </a>
                    @endif
                </div>
                <div class="lower_icons">
                    {{--<label class="switch">
                        <span class="sun"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="#ffd43b"><circle r="5" cy="12" cx="12"></circle><path d="m21 13h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2zm-17 0h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2zm13.66-5.66a1 1 0 0 1 -.66-.29 1 1 0 0 1 0-1.41l.71-.71a1 1 0 1 1 1.41 1.41l-.71.71a1 1 0 0 1 -.75.29zm-12.02 12.02a1 1 0 0 1 -.71-.29 1 1 0 0 1 0-1.41l.71-.66a1 1 0 0 1 1.41 1.41l-.71.71a1 1 0 0 1 -.7.24zm6.36-14.36a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1zm0 17a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1zm-5.66-14.66a1 1 0 0 1 -.7-.29l-.71-.71a1 1 0 0 1 1.41-1.41l.71.71a1 1 0 0 1 0 1.41 1 1 0 0 1 -.71.29zm12.02 12.02a1 1 0 0 1 -.7-.29l-.66-.71a1 1 0 0 1 1.36-1.36l.71.71a1 1 0 0 1 0 1.41 1 1 0 0 1 -.71.24z"></path></g></svg></span>
                        <span class="moon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="m223.5 32c-123.5 0-223.5 100.3-223.5 224s100 224 223.5 224c60.6 0 115.5-24.2 155.8-63.4 5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6-96.9 0-175.5-78.8-175.5-176 0-65.8 36-123.1 89.3-153.3 6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"></path></svg></span>
                        <input type="checkbox" class="input">
                        <span class="slider"></span>
                    </label>--}}
                    <button onclick="myFunction()" class="showhide">
                        <span> Hide </span>
                    </button>
                    <a href="{{ route('profile.edit') }}">
                    <img
                        class="change_color"
                        src="{{ asset('icons/sidebar/cog.svg') }}"
                        alt="cog"
                    />
                    </a>
                </div>
            </nav>
            <div id="mySIDEBAR" class="sidebar" data-intro="Toto je bočný panel. Nachádzajú sa tu tickety roztriedené do jednotlivých skupín." data-step="4">
                @if(request()->routeIs('tickets.*'))
                    <a href="{{ route('tickets.index.created') }}" class="drop_button_menu {{ request()->routeIs('tickets.index.created') ? 'active' : null }}">
                        <p>Moje tickety</p>
                        <div class="icon">
                            {{ \App\Models\Ticket::where('created_by', Auth::user()->id)->whereNot('status', 'closed')->count() }}
                        </div>
                    </a>
                    <a href="{{ route('tickets.index.created.closed') }}" class="drop_button_menu {{ request()->routeIs('tickets.index.created.closed') ? 'active' : null }}">
                        <p>Moje zatvorené tickety</p>
                        <div class="icon">
                            {{ \App\Models\Ticket::where('created_by', Auth::user()->id)->where('status', 'closed')->count() }}
                        </div>
                    </a>
                    @if(Auth::user()->isTeacher())
                        <a href="{{ route('tickets.index.assigned') }}" class="drop_button_menu {{ request()->routeIs('tickets.index.assigned') ? 'active' : null }}">
                            <p>Mne pridelené tickety</p>
                            <div class="icon">
                                {{ \App\Models\Ticket::where('assigned_to', Auth::user()->id)->whereNot('status', 'closed')->count() }}
                            </div>
                        </a>
                    @endif
                    @if(Auth::user()->isTeacher())
                        <a href="{{ route('tickets.index.assigned.closed') }}" class="drop_button_menu {{ request()->routeIs('tickets.index.assigned.closed') ? 'active' : null }}">
                            <p>Mne pridelené zatvorené tickety</p>
                            <div class="icon">
                                {{ \App\Models\Ticket::where('assigned_to', Auth::user()->id)->where('status', 'closed')->count() }}
                            </div>
                        </a>
                    @endif
                @elseif (request()->routeIs('groups.*'))
                    <a href="{{ route('groups.index') }}" class="drop_button_menu {{ request()->routeIs('groups.index') ? 'active' : null }}">
                        <p>Všetky skupiny</p>
                        <div class="icon">
                            {{ \App\Models\Group::all()->count() }}
                        </div>
                    </a>
                @endif


            </div>
            <div class="main" data-intro="Tu môžete vidieť zoznam všetkých ticketov z danej skupiny, ktorú máte vybratú." data-step="5">
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

        <script src="https://unpkg.com/intro.js/intro.js">           
        </script>
        <script>
            top_icons.addEventListener("click", function() {
                introJs().start()
            });
        </script>
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

        <script
            src="https://code.jquery.com/jquery-3.7.1.slim.js"
            integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc="
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('select').select2();
            });
        </script>
        
    </body>
</html>

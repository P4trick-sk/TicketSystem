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

        <script src="https://unpkg.com/@phosphor-icons/web"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script>
            !(function () {
                if (window.t4hto4) console.log('WiserNotify pixel installed multiple time in this page');
                else {
                    window.t4hto4 = !0;
                    var t = document,
                        e = window,
                        n = function () {
                            var e = t.createElement('script');
                            (e.type = 'text/javascript'),
                                (e.async = !0),
                                (e.src = 'https://pt.wisernotify.com/pixel.js?ti=1jclj6jkfc4hhry'),
                                document.body.appendChild(e);
                        };
                    'complete' === t.readyState ? n() : window.attachEvent ? e.attachEvent('onload', n) : e.addEventListener('load', n, !1);
                }
            })();
        </script>
        <!-- Microsoft clarity -->
        <script type="text/javascript">
            (function (c, l, a, r, i, t, y) {
                c[a] =
                    c[a] ||
                    function () {
                        (c[a].q = c[a].q || []).push(arguments);
                    };
                t = l.createElement(r);
                t.async = 1;
                t.src = 'https://www.clarity.ms/tag/' + i;
                y = l.getElementsByTagName(r)[0];
                y.parentNode.insertBefore(t, y);
            })(window, document, 'clarity', 'script', 'gkn6wuhrtb');
        </script>
    </head>
    <body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="light"> {{--<body class="font-sans antialiased body-container">--}}
       <!-- [ Pre-loader ] start -->
       <div class="loader-bg">
           <div class="loader-track">
               <div class="loader-fill"></div>
           </div>
       </div>
       <!-- [ Pre-loader ] End -->
       <!-- [ Sidebar Menu ] start -->
       <nav class="pc-sidebar">
           <div class="navbar-wrapper">
               <div class="m-header">
                   <a href="{{ route('tickets.index.created') }}" class="b-brand text-primary">
                       {{--<img src="{{ asset('img/logo.png') }}" class="img-fluid logo-lg" alt="logo">--}}
                       <span class="logo">TicketSystem</span>
                       <span class="badge bg-light-success rounded-pill ms-2 theme-version">v0.1</span>
                   </a>
               </div>
               <div class="navbar-content">
                   <div class="card pc-user-card">
                       <div class="card-body">
                           <div class="d-flex align-items-center">
                               @if(Auth::user()->avatar)
                               <div class="flex-shrink-0">
                                   <img src="{{ Auth::user()->avatar }}" alt="user-image" class="user-avtar wid-45 rounded-circle" />
                               </div>
                               @endif
                               <div class="flex-grow-1 ms-3 me-2">
                                   <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                   <small>{{ Auth::user()->role }}</small>
                               </div>
                               <a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse" href="#pc_sidebar_userlink">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="pc-icon icon icon-tabler icon-tabler-menu-deep" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                       <path d="M4 6h16" />
                                       <path d="M7 12h13" />
                                       <path d="M10 18h10" />
                                   </svg>
                               </a>
                           </div>
                           <div class="collapse pc-user-links" id="pc_sidebar_userlink">
                               <div class="pt-3">
                                   <a href="{{ route('profile.edit') }}">
                                       <i class="ti ti-settings"></i>
                                       <span>{{ __('Nastavenia') }}</span>
                                   </a>
                                   <form method="POST" action="{{ route('logout') }}">
                                       @csrf

                                       <a href="#!" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                           <i class="ti ti-power"></i>
                                           <span>{{ __('Odhlásiť') }}</span>
                                       </a>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>

                   <ul class="pc-navbar">
                       <li class="pc-item pc-caption">
                           <label>{{ __('Moje tickety') }}</label>
                       </li>
                       <li class="pc-item">
                           <a href="{{ route('tickets.index.created') }}" class="pc-link">
                                <span class="pc-micon">
                                  <svg class="pc-icon">
                                    <use xlink:href="#custom-story"></use>
                                  </svg>
                                </span>
                               <span class="pc-mtext">{{ __('Aktívne') }}</span>
                               <span class="pc-badge">{{ \App\Models\Ticket::where('created_by', Auth::user()->id)->whereNot('status', 'closed')->count() }}</span>
                           </a>
                       </li>
                       <li class="pc-item">
                           <a href="{{ route('tickets.index.created.closed') }}" class="pc-link">
                                <span class="pc-micon">
                                  <svg class="pc-icon">
                                    <use xlink:href="#custom-story"></use>
                                  </svg>
                                </span>
                               <span class="pc-mtext">{{ __('Zatvorené') }}</span>
                               <span class="pc-badge">{{ \App\Models\Ticket::where('created_by', Auth::user()->id)->where('status', 'closed')->count() }}</span>
                           </a>
                       </li>
                       @if(Auth::user()->isTeacher())
                       <li class="pc-item pc-caption">
                           <label>{{ __('Mne pridelené tickety') }}</label>
                       </li>
                       <li class="pc-item">
                           <a href="{{ route('tickets.index.assigned') }}" class="pc-link">
                                <span class="pc-micon">
                                  <svg class="pc-icon">
                                    <use xlink:href="#custom-story"></use>
                                  </svg>
                                </span>
                               <span class="pc-mtext">{{ __('Aktívne') }}</span>
                               <span class="pc-badge">{{ \App\Models\Ticket::where('assigned_to', Auth::user()->id)->whereNot('status', 'closed')->count() }}</span>
                           </a>
                       </li>
                       <li class="pc-item">
                           <a href="{{ route('tickets.index.assigned.closed') }}" class="pc-link">
                                <span class="pc-micon">
                                  <svg class="pc-icon">
                                    <use xlink:href="#custom-story"></use>
                                  </svg>
                                </span>
                               <span class="pc-mtext">{{ __('Zatvorené') }}</span>
                               <span class="pc-badge">{{ \App\Models\Ticket::where('assigned_to', Auth::user()->id)->where('status', 'closed')->count() }}</span>
                           </a>
                       </li>
                       <li class="pc-item pc-caption">
                           <label>{{ __('Skupiny ticketov') }}</label>
                       </li>
                       <li class="pc-item">
                           <a href="{{ route('groups.index') }}" class="pc-link">
                                <span class="pc-micon">
                                  <svg class="pc-icon">
                                    <use xlink:href="#custom-story"></use>
                                  </svg>
                                </span>
                               <span class="pc-mtext">{{ __('Všetky skupiny') }}</span>
                           </a>
                       </li>
                       @endif
                   </ul>
               </div>
           </div>
       </nav>
       <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
       <header class="pc-header">
           <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
               <div class="me-auto pc-mob-drp">
                   <ul class="list-unstyled">
                       <!-- ======= Menu collapse Icon ===== -->
                       <li class="pc-h-item pc-sidebar-collapse">
                           <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                               <i class="ti ti-menu-2"></i>
                           </a>
                       </li>
                       <li class="pc-h-item pc-sidebar-popup">
                           <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                               <i class="ti ti-menu-2"></i>
                           </a>
                       </li>
                   </ul>
               </div>
               <!-- [Mobile Media Block end] -->
               <div class="ms-auto">
                   <ul class="list-unstyled">
                       <li class="dropdown pc-h-item">
                           <a
                                   class="pc-head-link dropdown-toggle arrow-none me-0"
                                   data-bs-toggle="dropdown"
                                   href="#"
                                   role="button"
                                   aria-haspopup="false"
                                   aria-expanded="false"
                           >
                               <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-plus-filled" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                   <path d="M12 2l.324 .001l.318 .004l.616 .017l.299 .013l.579 .034l.553 .046c4.785 .464 6.732 2.411 7.196 7.196l.046 .553l.034 .579c.005 .098 .01 .198 .013 .299l.017 .616l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.464 4.785 -2.411 6.732 -7.196 7.196l-.553 .046l-.579 .034c-.098 .005 -.198 .01 -.299 .013l-.616 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.785 -.464 -6.732 -2.411 -7.196 -7.196l-.046 -.553l-.034 -.579a28.058 28.058 0 0 1 -.013 -.299l-.017 -.616c-.003 -.21 -.005 -.424 -.005 -.642l.001 -.324l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.464 -4.785 2.411 -6.732 7.196 -7.196l.553 -.046l.579 -.034c.098 -.005 .198 -.01 .299 -.013l.616 -.017c.21 -.003 .424 -.005 .642 -.005zm0 6a1 1 0 0 0 -1 1v2h-2l-.117 .007a1 1 0 0 0 .117 1.993h2v2l.007 .117a1 1 0 0 0 1.993 -.117v-2h2l.117 -.007a1 1 0 0 0 -.117 -1.993h-2v-2l-.007 -.117a1 1 0 0 0 -.993 -.883z" fill="currentColor" stroke-width="0" />
                               </svg>
                           </a>
                           <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                               <div class="dropdown-body text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
                                   <div class="card mb-2">
                                       <div class="card-body">
                                           <a href="{{ route('tickets.create') }}" class="d-flex align-items-center">
                                               <div class="flex-shrink-0">
                                                   <svg xmlns="http://www.w3.org/2000/svg" class="pc-icon text-primary icon icon-tabler icon-tabler-notes" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                       <path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                                                       <path d="M9 7l6 0" />
                                                       <path d="M9 11l6 0" />
                                                       <path d="M9 15l4 0" />
                                                   </svg>
                                               </div>
                                               <div class="flex-grow-1 ms-3">
                                                   <h5 class="text-body mb-0">{{ __('Ticket') }}</h5>
                                               </div>
                                           </a>
                                       </div>
                                   </div>
                                   <div class="card mb-0">
                                       <div class="card-body">
                                           <a href="{{ route('groups.create') }}" class="d-flex align-items-center">
                                               <div class="flex-shrink-0">
                                                   <svg xmlns="http://www.w3.org/2000/svg" class="pc-icon text-primary icon icon-tabler icon-tabler-list" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                       <path d="M9 6l11 0" />
                                                       <path d="M9 12l11 0" />
                                                       <path d="M9 18l11 0" />
                                                       <path d="M5 6l0 .01" />
                                                       <path d="M5 12l0 .01" />
                                                       <path d="M5 18l0 .01" />
                                                   </svg>
                                               </div>
                                               <div class="flex-grow-1 ms-3">
                                                   <h5 class="text-body mb-0">{{ __('Skupina ticketov') }}</h5>
                                               </div>
                                           </a>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </li>
                       <li class="dropdown pc-h-item">
                           <a
                               class="pc-head-link dropdown-toggle arrow-none me-0"
                               data-bs-toggle="dropdown"
                               href="#"
                               role="button"
                               aria-haspopup="false"
                               aria-expanded="false"
                           >
                               <svg xmlns="http://www.w3.org/2000/svg" class="pc-icon icon icon-tabler icon-tabler-bell-filled" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                   <path d="M14.235 19c.865 0 1.322 1.024 .745 1.668a3.992 3.992 0 0 1 -2.98 1.332a3.992 3.992 0 0 1 -2.98 -1.332c-.552 -.616 -.158 -1.579 .634 -1.661l.11 -.006h4.471z" stroke-width="0" fill="currentColor" />
                                   <path d="M12 2c1.358 0 2.506 .903 2.875 2.141l.046 .171l.008 .043a8.013 8.013 0 0 1 4.024 6.069l.028 .287l.019 .289v2.931l.021 .136a3 3 0 0 0 1.143 1.847l.167 .117l.162 .099c.86 .487 .56 1.766 -.377 1.864l-.116 .006h-16c-1.028 0 -1.387 -1.364 -.493 -1.87a3 3 0 0 0 1.472 -2.063l.021 -.143l.001 -2.97a8 8 0 0 1 3.821 -6.454l.248 -.146l.01 -.043a3.003 3.003 0 0 1 2.562 -2.29l.182 -.017l.176 -.004z" stroke-width="0" fill="currentColor" />
                               </svg>
                               <span class="badge bg-success pc-h-badge">3</span>
                           </a>
                           <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                               <div class="dropdown-header d-flex align-items-center justify-content-between">
                                   <h5 class="m-0">Notifications</h5>
                                   <a href="#!" class="btn btn-link btn-sm">Mark all read</a>
                               </div>
                               <div class="dropdown-body text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
                                   <p class="text-span">Today</p>
                                   <div class="card mb-2">
                                       <div class="card-body">
                                           <div class="d-flex">
                                               <div class="flex-shrink-0">
                                                   <svg class="pc-icon text-primary">
                                                       <use xlink:href="#custom-layer"></use>
                                                   </svg>
                                               </div>
                                               <div class="flex-grow-1 ms-3">
                                                   <span class="float-end text-sm text-muted">2 min ago</span>
                                                   <h5 class="text-body mb-2">UI/UX Design</h5>
                                                   <p class="mb-0"
                                                   >Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                                       type and scrambled it to make a type</p
                                                   >
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card mb-2">
                                       <div class="card-body">
                                           <div class="d-flex">
                                               <div class="flex-shrink-0">
                                                   <svg class="pc-icon text-primary">
                                                       <use xlink:href="#custom-sms"></use>
                                                   </svg>
                                               </div>
                                               <div class="flex-grow-1 ms-3">
                                                   <span class="float-end text-sm text-muted">1 hour ago</span>
                                                   <h5 class="text-body mb-2">Message</h5>
                                                   <p class="mb-0">Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</p>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <p class="text-span">Yesterday</p>
                                   <div class="card mb-2">
                                       <div class="card-body">
                                           <div class="d-flex">
                                               <div class="flex-shrink-0">
                                                   <svg class="pc-icon text-primary">
                                                       <use xlink:href="#custom-document-text"></use>
                                                   </svg>
                                               </div>
                                               <div class="flex-grow-1 ms-3">
                                                   <span class="float-end text-sm text-muted">2 hour ago</span>
                                                   <h5 class="text-body mb-2">Forms</h5>
                                                   <p class="mb-0"
                                                   >Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                                       type and scrambled it to make a type</p
                                                   >
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card mb-2">
                                       <div class="card-body">
                                           <div class="d-flex">
                                               <div class="flex-shrink-0">
                                                   <svg class="pc-icon text-primary">
                                                       <use xlink:href="#custom-user-bold"></use>
                                                   </svg>
                                               </div>
                                               <div class="flex-grow-1 ms-3">
                                                   <span class="float-end text-sm text-muted">12 hour ago</span>
                                                   <h5 class="text-body mb-2">Challenge invitation</h5>
                                                   <p class="mb-2"><span class="text-dark">Jonny aber</span> invites to join the challenge</p>
                                                   <button class="btn btn-sm btn-outline-secondary me-2">Decline</button>
                                                   <button class="btn btn-sm btn-primary">Accept</button>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card mb-2">
                                       <div class="card-body">
                                           <div class="d-flex">
                                               <div class="flex-shrink-0">
                                                   <svg class="pc-icon text-primary">
                                                       <use xlink:href="#custom-security-safe"></use>
                                                   </svg>
                                               </div>
                                               <div class="flex-grow-1 ms-3">
                                                   <span class="float-end text-sm text-muted">5 hour ago</span>
                                                   <h5 class="text-body mb-2">Security</h5>
                                                   <p class="mb-0"
                                                   >Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                                       type and scrambled it to make a type</p
                                                   >
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="text-center py-2">
                                   <a href="#!" class="link-danger">Clear all Notifications</a>
                               </div>
                           </div>
                       </li>
                   </ul>
               </div>
           </div>
       </header>
       <!-- [ Header ] end -->



       <!-- [ Main Content ] start -->
        <div class="pc-container">
            <div class="pc-content">
                {{ $slot }}
            </div>
        </div>
       <!-- [ Main Content ] end -->
       <footer class="pc-footer">
           <div class="footer-wrapper container-fluid">
               <div class="row">
                   <div class="col my-1">
                       <p class="m-0"></p>
                   </div>
                   <div class="col-auto my-1">
                       <ul class="list-inline footer-link mb-0">
                           <li class="list-inline-item"><a href="{{ route('tickets.index.created') }}">Home</a></li>
                       </ul>
                   </div>
               </div>
           </div>
       </footer>
       <div class="pct-c-btn">
           <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_pc_layout">
               <i class="ph-duotone ph-gear-six"></i>
           </a>
       </div>
       <div class="offcanvas border-0 pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
           <div class="offcanvas-header">
               <h5 class="offcanvas-title">Settings</h5>
               <button type="button" class="btn btn-icon btn-link-danger" data-bs-dismiss="offcanvas" aria-label="Close"><i
                       class="ti ti-x"></i></button>
           </div>
           <div class="pct-body customizer-body">
               <div class="offcanvas-body py-0">
                   <ul class="list-group list-group-flush">
                       <li class="list-group-item">
                           <h6 class="mb-1">Custom Theme</h6>
                           <p class="text-muted text-sm">Choose your primary theme color</p>
                           <div class="theme-color preset-color">
                               <a href="#!" data-bs-toggle="tooltip" title="Blue" class="active" data-value="preset-1"><i class="ti ti-checks"></i></a>
                               <a href="#!" data-bs-toggle="tooltip" title="Indigo" data-value="preset-2"><i class="ti ti-checks"></i></a>
                               <a href="#!" data-bs-toggle="tooltip" title="Purple" data-value="preset-3"><i class="ti ti-checks"></i></a>
                               <a href="#!" data-bs-toggle="tooltip" title="Pink" data-value="preset-4"><i class="ti ti-checks"></i></a>
                               <a href="#!" data-bs-toggle="tooltip" title="Red" data-value="preset-5"><i class="ti ti-checks"></i></a>
                               <a href="#!" data-bs-toggle="tooltip" title="Orange" data-value="preset-6"><i class="ti ti-checks"></i></a>
                               <a href="#!" data-bs-toggle="tooltip" title="Yellow" data-value="preset-7"><i class="ti ti-checks"></i></a>
                               <a href="#!" data-bs-toggle="tooltip" title="Green" data-value="preset-8"><i class="ti ti-checks"></i></a>
                               <a href="#!" data-bs-toggle="tooltip" title="Teal" data-value="preset-9"><i class="ti ti-checks"></i></a>
                               <a href="#!" data-bs-toggle="tooltip" title="Cyan" data-value="preset-10"><i class="ti ti-checks"></i></a>
                           </div>
                       </li>
                   </ul>
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
        <script
            src="https://code.jquery.com/jquery-3.7.1.slim.js"
            integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc="
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('select').select2();
            });
            $('.select2').select2({
                templateResult: formatResult, // Format how options appear in the dropdown
                templateSelection: formatSelection // Format the selected option
            });
            function formatResult(result) {
                return $('<span class="form-select">' + result.text + '</span>');
            }

            function formatSelection(selection) {
                return $('<span class="form-select">' + selection.text + '</span>');
            }
        </script>
    </body>
</html>

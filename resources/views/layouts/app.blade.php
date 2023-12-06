<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title ?? 'Title' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ asset('') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/iconfonts/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/vendor.bundle.addons.css') }}">

    <link rel="stylesheet" href="{{ asset('theme/css/style.css') }}">

    <link rel="shortcut icon" href="http://www.urbanui.com/" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    {{ $headerStyles ?? ''}}
    {{ $headerScripts ?? ''}}

    @livewireStyles
    @stack('styles')

</head>

<body class="sidebar-fixed">
    <div class="container-scroller">

        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
            <x-layouts.top-header></x-layouts.top-header>
        </nav>

        <div class="container-fluid page-body-wrapper">

            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="fas fa-fill-drip"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close fa fa-times"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles primary"></div>
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>

            <nav class="sidebar sidebar-offcanvas" id="sidebar">

                <x-layouts.sidebar></x-layouts.sidebar>

            </nav>

            <div class="main-panel">
                <div class="content-wrapper">

                    {{ $slot }}

                </div>

                <x-layouts.footer></x-layouts.footer>

            </div>

        </div>

    </div>

    <script src="{{ asset('theme/vendors/js/vendor.bundle.base.js?v=' . time()) }}"></script>
    <script src="{{ asset('theme/vendors/js/vendor.bundle.addons.js?v=' . time()) }}"></script>

    <script src="{{ asset('theme/js/off-canvas.js?v=' . time()) }}"></script>
    <script src="{{ asset('theme/js/hoverable-collapse.js?v=' . time()) }}"></script>
    <script src="{{ asset('theme/js/misc.js?v=' . time()) }}"></script>
    <script src="{{ asset('theme/js/settings.js?v=' . time()) }}"></script>
    <script src="{{ asset('theme/js/todolist.js?v=' . time()) }}"></script>

    <script src="{{ asset('theme/js/dashboard.js') }}"></script>

    <script src="{{ asset('js/swal.js?v=' . time()) }}"></script>

    {{ $footerScripts ?? ''}}

    @livewireScripts
    @stack('scripts');

    
</body>

</html>





{{-- <!DOCTYPE html>
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

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html> --}}

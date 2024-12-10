<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <!-- Favicon -->
        <link rel="icon" href="{{ asset('nis2-cc-logo.png') }}" type="image/png" media="(prefers-color-scheme:light)">
        <link rel="icon" href="{{ asset('nis2-cc-logo-white.png') }}" type="image/png" media="(prefers-color-scheme:dark)">

        <title>@yield('title', 'NIS2 Compliance Checker')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
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
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    </body>


    <footer>
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 NIS2 CC™</span>
            <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                <li>
                    <a href="{{ route('welcome') }}" class="hover:underline me-4 md:me-6">{{ __('strings.nis2-cc') }}</a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="hover:underline me-4 md:me-6">{{ __('strings.dashboard') }}</a>
                </li>
                    <li>
                        <a href="{{ route('my-organizations.index') }}" class="hover:underline me-4 md:me-6">{{ __('strings.organizations') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('informations') }}" class="hover:underline me-4 md:me-6">{{ __('strings.informations') }}</a>
                    </li>
            </ul>
        </div>
    </footer>


</html>

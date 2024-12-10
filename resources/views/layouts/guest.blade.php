<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'NIS2 Compliance Checker')</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('nis2-cc-logo.png') }}" type="image/png" media="(prefers-color-scheme:light)">
        <link rel="icon" href="{{ asset('nis2-cc-logo-white.png') }}" type="image/png" media="(prefers-color-scheme:dark)">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="{{ route('welcome')}}">
                    <div style="margin-bottom: 14px" class="flex items-center justify-center lg:col-start-2">
                        <img style="width: auto; height: 100px; " src="{{ asset('nis2-cc-logo-purple.png') }}">
                        <h1 style="padding: 25px; color: #6366f1; font-size: 35px" class="text-xl font-semibold text-black dark:text-white">{{ __('strings.nis2-cc') }}</h1>
                    </div>
                </a>
            </div>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite('resources/css/app.css')
        @vite('resources/js/index.js')
        <title>{{ config('app.name', 'Laravel') }}</title>


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased scroll-smooth min-h-screen bg-gradient-to-tr from-lightPink to-lightBlue">
        <div class="grid grid-cols-1 grid-rows-[100px, auto] gap-y-1">
             <!-- Loader for information -->
            <div id="preloader">
                <div class="spinner p-0 m-0">
                </div>
            </div>

            <!-- Company Logo -->
            <div class="m-0 p-2">
                <img src="{{ url('storage/logo/exchange_rate.svg') }}" 
                    alt="Company Logo"
                    class="w-14 h-12">
            </div>

            <!-- Page Content -->
            <main>
                {{-- {{ $slot }} --}}
                @yield('body__content')
            </main>
        </div>

 @if (!isset($excludeNav) || !$excludeNav)
        @include('layouts.navigation')
@endif
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title', 'Authentication')</title>

    @include('partials.translations')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-gradient-to-br from-gray-900 via-blue-900 to-black min-h-screen flex flex-col">
<div class="flex-grow flex items-center justify-center px-6 my-12">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="bg-blue-500 bg-opacity-10 w-20 h-20 rounded-full mx-auto mb-4 flex items-center justify-center">
                <i class="fas fa-lock text-blue-400 text-3xl"></i>
            </div>
            <h1 class="text-white text-3xl font-bold">{{ config('app.name') }}</h1>
            <p class="text-gray-400 mt-2">@yield('subtitle')</p>
        </div>

        @yield('content')
    </div>
</div>

@include('partials.footer')

@stack('scripts')
</body>
</html>

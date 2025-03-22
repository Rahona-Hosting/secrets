<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title', 'Secret Viewer')</title>

    @include('partials.translations')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta property="og:title" content="{{ __('messages.og.title') }}">
    <meta property="og:description"
          content="{{ __('messages.og.description') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/secret-share-preview.png') }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">

    <!-- Twitter Card tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ __('messages.og.title') }}">
    <meta name="twitter:description"
          content="{{ __('messages.og.description') }}">
    <meta name="twitter:image" content="{{ asset('images/secret-share-preview.png') }}">

    <!-- JSON-LD -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "name": "{{ __('messages.og.title') }}",
            "description": "{{ __('messages.og.description') }}",
            "publisher": {
                "@type": "Organization",
                "name": "{{ config('app.name') }}"
        },
        "url": "{{ url()->current() }}"
    }
    </script>

    @livewireStyles
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-gray-900 via-blue-900 to-black min-h-screen flex flex-col">
@include('partials.toast')
<div class="flex-grow flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <!-- Container principal -->
        <div
            class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-8 shadow-2xl transform transition-all duration-500 hover:scale-105">
            <!-- Logo et Titre -->
            <div class="text-center mb-8">
                <div
                    class="bg-blue-500 bg-opacity-10 w-20 h-20 rounded-full mx-auto mb-4 flex items-center justify-center">
                    @yield('icon')
                </div>
                <h1 class="text-white text-3xl font-bold">{{ config('app.name') }}</h1>
                <p class="text-gray-400 mt-2">@yield('subtitle')</p>
            </div>

            @yield('content')
        </div>

        <div class="text-center mt-6 text-gray-400 text-sm">
            <p>{{ __('messages.slogan') }}</p>
        </div>
    </div>
</div>

@include('partials.footer')

@livewireScripts
@stack('scripts')
</body>
</html>

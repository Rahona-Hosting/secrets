<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title', __('messages.dashboard'))</title>

    @include('partials.translations')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-gray-900 via-blue-900 to-black min-h-screen flex flex-col">
<header class="bg-white bg-opacity-5 backdrop-blur-lg border-b border-blue-800 relative z-50">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="flex items-center">
            <i class="fas fa-home text-blue-400 text-2xl mr-3"></i>
            <h1 class="text-white text-xl font-bold">{{ __('messages.dashboard') }}</h1>
        </a>
        <nav class="flex items-center space-x-4">
            {{ $navigation ?? '' }}
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button id="userDropdownButton" data-dropdown-toggle="userDropdown"
                            class="flex items-center text-gray-300 hover:text-blue-400">
                        <i class="fas fa-user-circle mr-2"></i>
                        {{ Auth::user()->email }}
                        <i class="fas fa-chevron-down ml-2"></i>
                    </button>

                    <div id="userDropdown"
                         class="hidden absolute right-0 mt-2 w-48 bg-white bg-opacity-10 backdrop-blur-lg rounded-md shadow-lg z-50">
                        <ul class="py-2">
                            <li>
                                <a href="{{ route('user.profile') }}"
                                   class="block px-4 py-2 text-gray-300 hover:bg-blue-600 hover:text-white">
                                    <i class="fas fa-user mr-2"></i>{{ __('messages.my_account') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.apis') }}"
                                   class="block px-4 py-2 text-gray-300 hover:bg-blue-600 hover:text-white">
                                    <i class="fas fa-key mr-2"></i>{{ __('messages.apis') }}
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full text-left px-4 py-2 text-gray-300 hover:bg-blue-600 hover:text-white">
                                        <i class="fas fa-sign-out-alt mr-2"></i>{{ __('messages.logout') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

@include('partials.toast')

<!-- Main Content -->
<main class="container mx-auto px-4 py-8 flex-grow">
    @yield('content')
</main>

@livewireScripts

@stack('scripts')

@include('partials.footer')
</body>
</html>

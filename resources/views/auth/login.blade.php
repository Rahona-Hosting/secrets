@php use Rahona\Helpers\SSOProviders; @endphp
@extends('layouts.auth')

@section('title', __('auth.login.title'))
@section('subtitle', __('auth.login.subtitle'))

@section('content')
    @if ($errors->any())
        <div class="bg-red-500 bg-opacity-10 border border-red-800 text-red-300 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(config('services.local-auth.enable'))
        <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-8 border border-blue-800 mb-6">
            <form id="loginForm" class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label class="block text-gray-300 text-sm font-bold mb-2">
                        {{ __('auth.login.email') }}
                    </label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="email"
                               name="email"
                               autocomplete="username"
                               value="{{ old('email') }}"
                               class="w-full bg-blue-900 bg-opacity-10 border @error('email') border-red-500 @else border-blue-800 @enderror rounded-lg py-3 px-10 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                               placeholder="{{ __('auth.login.email_placeholder') }}" required>
                    </div>
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <label class="block text-gray-300 text-sm font-bold mb-2">
                        {{ __('auth.login.password') }}
                    </label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="password"
                               name="password"
                               autocomplete="current-password"
                               class="w-full bg-blue-900 bg-opacity-10 border @error('password') border-red-500 @else border-blue-800 @enderror rounded-lg py-3 px-10 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                               placeholder="••••••••" required>
                        <button type="button"
                                class="toggle-password absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-300">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember_me"
                               class="form-checkbox h-4 w-4 text-blue-500 rounded border-gray-600 bg-gray-700">
                        <input type="hidden" name="remember" value="false">
                        <span class="ml-2 text-sm text-gray-300">{{ __('auth.login.remember_me') }}</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-400 hover:text-blue-300">
                        {{ __('auth.login.password_forgot') }}
                    </a>
                </div>

                <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transform transition-all duration-300 hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    {{ __('auth.login.connect_button') }}
                </button>
            </form>
        </div>

        <p class="text-center mt-2 mb-4 text-gray-400">
            {{ __('auth.login.no_account') }}
            <a href="{{ route('register') }}"
               class="text-blue-400 hover:text-blue-300">{{ __('auth.login.create_account') }}</a>
        </p>
    @endif

    @if(config('services.local-auth.enable') && !empty(SSOProviders::getEnabledSocialiteProviders()))
        <div class="divider mb-6">
            <span class="px-3 text-sm text-gray-400">{{ __('auth.login.or') }}</span>
        </div>
    @endif

    <!-- SSO -->
    <div class="space-y-4">
        @foreach(SSOProviders::getEnabledSocialiteProviders() as $provider => $config)
            <a href="{{ route('socialite.redirect', $provider) }}"
               class="w-full {{ $config['classes'] }} font-bold py-3 px-4 rounded-lg transform transition-all duration-300 hover:scale-105 flex items-center justify-center">
                <i class="{{ $config['icon'] }} mr-2"></i>
                {{ $config['name'] }}
            </a>
        @endforeach
    </div>
@endsection

@vite('resources/js/auth/login.js')

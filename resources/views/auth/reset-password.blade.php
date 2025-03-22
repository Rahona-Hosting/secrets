@extends('layouts.auth')

@section('title', __('auth.reset_password.title'))
@section('subtitle', __('auth.reset_password.subtitle'))

<style>
    .password-strength-meter {
        height: 4px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 2px;
        overflow: hidden;
        transition: all 0.3s;
    }

    .password-strength-meter div {
        height: 100%;
        width: 0;
        transition: all 0.3s;
    }
</style>

@section('content')
    <!-- todo reuse -->
    @if ($errors->any())
        <div class="bg-red-500 bg-opacity-10 border border-red-800 text-red-300 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-8 border border-blue-800 mb-6">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <input type="hidden" name="email" value="{{ $request->email }}">

            <div class="input-group">
                <label class="block text-gray-300 text-sm font-bold mb-2">
                    {{ __('auth.reset_password.new_password') }}
                </label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="password"
                           name="password"
                           id="password"
                           class="w-full bg-blue-900 bg-opacity-10 border @error('password') border-red-500 @else border-blue-800 @enderror rounded-lg py-3 px-10 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                           placeholder="••••••••" required>
                    <button type="button"
                            class="toggle-password absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-300">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <div class="mt-2">
                    <div class="password-strength-meter">
                        <div id="strengthMeter" class="bg-red-500"></div>
                    </div>
                    <p class="mt-1 text-sm">
                        <span id="strengthText" class="text-red-400">{{ __('auth.register.password_weak') }}</span>
                    </p>
                </div>
            </div>

            <div class="input-group mt-6">
                <label class="block text-gray-300 text-sm font-bold mb-2">
                    {{ __('auth.register.reset_password.confirm_new_password') }}
                </label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           class="w-full bg-blue-900 bg-opacity-10 border border-blue-800 rounded-lg py-3 px-10 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                           placeholder="••••••••" required>
                </div>
                <p id="matchMessage" class="mt-1 text-sm hidden text-red-400">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ __('auth.register.password_not_match') }}
                </p>
            </div>

            <div class="bg-blue-900 bg-opacity-10 rounded-lg p-4">
                <h4 class="text-gray-300 text-sm font-bold mb-2">
                    {{ __('auth.register.password_criteria') }}
                </h4>
                <ul class="space-y-1 text-sm">
                    <li id="lengthCheck" class="text-gray-400">
                        <i class="fas fa-times-circle mr-2"></i>
                        {{ __('auth.register.password_criteria_minimum') }}
                    </li>
                    <li id="upperCheck" class="text-gray-400">
                        <i class="fas fa-times-circle mr-2"></i>
                        {{ __('auth.register.password_criteria_upper') }}
                    </li>
                    <li id="lowerCheck" class="text-gray-400">
                        <i class="fas fa-times-circle mr-2"></i>
                        {{ __('auth.register.password_criteria_lower') }}
                    </li>
                    <li id="numberCheck" class="text-gray-400">
                        <i class="fas fa-times-circle mr-2"></i>
                        {{ __('auth.register.password_criteria_number') }}
                    </li>
                    <li id="specialCheck" class="text-gray-400">
                        <i class="fas fa-times-circle mr-2"></i>
                        {{ __('auth.register.password_criteria_special') }}
                    </li>
                </ul>
            </div>

            <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transform transition-all duration-300 hover:scale-105 mt-6">
                <i class="fas fa-key mr-2"></i>
                {{ __('auth.reset_password.submit')  }}
            </button>
        </form>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/auth/register.js'])
@endpush

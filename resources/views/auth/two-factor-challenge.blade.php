@extends('layouts.auth')

@section('title', __('2fa.challenge.title'))
@section('subtitle', __('2fa.challenge.subtitle'))

@section('content')
    <div class="mb-4">
        @if($errors->any())
            <div class="text-red-400 bg-red-400 bg-opacity-10 rounded-lg p-3">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ $errors->first() }}
            </div>
        @endif
    </div>

    <div id="otpForm" class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-8 border border-blue-800 mb-6">
        <form method="POST" action="{{ route('two-factor.login') }}" id="verificationForm" class="space-y-6">
            @csrf

            <div class="text-sm text-gray-300 mb-4">
                <p class="mb-2">
                    <i class="fas fa-info-circle mr-2 text-blue-400"></i>
                    {{ __('2fa.challenge.message') }}
                </p>
            </div>

            <div class="space-y-4">
                <div class="flex justify-center space-x-3">
                    <input type="text" maxlength="1" class="otp-input" data-next="2">
                    <input type="text" maxlength="1" class="otp-input" data-next="3">
                    <input type="text" maxlength="1" class="otp-input" data-next="4">
                    <input type="text" maxlength="1" class="otp-input" data-next="5">
                    <input type="text" maxlength="1" class="otp-input" data-next="6">
                    <input type="text" maxlength="1" class="otp-input" data-next="submit">
                </div>

                <input type="hidden" name="code" id="codeInput">

                <p id="errorMessage" class="hidden text-red-400 text-sm text-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ __('2fa.challenge.error_message') }}
                </p>
            </div>

            <button type="submit"
                    id="submitButton"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transform transition-all duration-300 hover:scale-105 flex items-center justify-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ __('2fa.challenge.submit') }}
            </button>

            <div class="text-center">
                <p class="text-gray-400 text-sm mb-2">- {{ __('2fa.challenge.or') }} -</p>
                <button type="button"
                        onclick="toggleRecoveryCode()"
                        class="text-blue-400 hover:text-blue-300 text-sm">
                    <i class="fas fa-key mr-1"></i>
                    {{ __('2fa.challenge.backup_code') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('two-factor.login') }}" id="recoveryForm" class="hidden space-y-6 mt-6">
            @csrf
            <div class="space-y-4">
                <input type="text"
                       name="recovery_code"
                       class="w-full bg-blue-900 bg-opacity-10 border border-blue-800 rounded-lg py-3 px-4 text-white placeholder-gray-400"
                       placeholder="{{ __('2fa.challenge.backup_code_placeholder') }}">

                <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg">
                    <i class="fas fa-key mr-2"></i>
                    {{ __('2fa.challenge.backup_code_submit') }}
                </button>

                <button type="button"
                        onclick="toggleRecoveryCode()"
                        class="w-full text-blue-400 hover:text-blue-300 text-sm">
                    <i class="fas fa-arrow-left mr-1"></i>
                    {{ __('2fa.challenge.backup_code_return_otp') }}
                </button>
            </div>
        </form>
    </div>

    <style>
        .otp-input {
            width: 3rem;
            height: 3.5rem;
            font-size: 1.5rem;
            text-align: center;
            border-radius: 0.5rem;
            border: 1px solid #2563EB;
            background: rgba(30, 58, 138, 0.1);
            color: white;
            transition: all 0.3s;
        }

        .otp-input:focus {
            outline: none;
            border-color: #3B82F6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
            transform: scale(1.05);
        }
    </style>
@endsection

@push('scripts')
    @vite(['resources/js/auth/2fa.js'])
@endpush

@extends('layouts.auth')

@section('title', __('auth.forgot_password.title'))
@section('subtitle', __('auth.forgot_password.subtitle'))

@section('content')
    @if (session('status'))
        <div class="bg-green-500 bg-opacity-10 border border-green-800 text-green-300 px-4 py-3 rounded-lg mb-6">
            {{ session('status') }}
        </div>
    @endif

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
        <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
            @csrf
            <div class="input-group">
                <label class="block text-gray-300 text-sm font-bold mb-2">
                    {{ __('auth.forgot_password.email') }}
                </label>
                <div class="relative">
                    <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="w-full bg-blue-900 bg-opacity-10 border border-blue-800 rounded-lg py-3 px-10 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                           placeholder="vous@exemple.com"
                           required>
                </div>
                <p class="mt-2 text-sm text-gray-400">
                    <i class="fas fa-info-circle mr-1"></i>
                    {{ __('auth.forgot_password.message') }}
                </p>
            </div>

            <div class="flex flex-col space-y-3">
                <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transform transition-all duration-300 hover:scale-105 flex items-center justify-center">
                    <i class="fas fa-paper-plane mr-2"></i>
                    {{ __('auth.forgot_password.send_link') }}
                </button>

                <a href="{{ route('login') }}"
                   class="w-full bg-transparent border border-blue-800 hover:bg-white hover:bg-opacity-5 text-white font-bold py-3 px-4 rounded-lg transform transition-all duration-300 hover:scale-105 flex items-center justify-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    {{ __('auth.forgot_password.return_login') }}
                </a>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <style>
        .input-group:focus-within i {
            color: #60A5FA;
        }
    </style>
@endpush

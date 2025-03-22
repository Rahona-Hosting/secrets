@extends('layouts.dashboard')

@section('title', __('secret.title'))

@section('content')
    <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-6 border border-blue-800 mb-8">
        <div class="flex items-center">
            <div class="w-16 h-16 rounded-full bg-blue-500 bg-opacity-20 flex items-center justify-center">
                <i class="fas fa-user text-2xl text-blue-400"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-white text-xl font-bold">{{ __('home.welcome') }}, {{ auth()->user()->name }}</h2>
                <p class="text-gray-300">{{ auth()->user()->email }}</p>
                <a href="{{ route('user.profile') }}" class="text-blue-400 hover:text-blue-300 text-sm">
                    <i class="fas fa-cog mr-1"></i>{{ __('home.handle_account') }}
                </a>
            </div>
        </div>
    </div>

    <livewire:stats/>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-white text-2xl font-bold">{{ __('home.secrets_list') }}</h2>
        <button type="button"
                class="new-secret-btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center transition-all duration-300">
            <i class="fas fa-plus mr-2"></i>
            {{ __('home.new_secret') }}
        </button>
    </div>

    @if(auth()->user()->secrets()->count() === 0)
        <div class="p-12 text-center">
            <div class="w-16 h-16 bg-blue-500 bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-lock text-2xl text-blue-400"></i>
            </div>
            <h3 class="text-white text-lg font-bold mb-2">{{ __('home.no_secret') }}</h3>
            <p class="text-gray-400 mb-6">{{ __('home.no_secret_add') }}</p>
            <button
                type="button"
                class="new-secret-btn bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg inline-flex items-center transition-all duration-300">
                <i class="fas fa-plus mr-2"></i>
                {{ __('home.create_secret') }}
            </button>
        </div>
    @else
        <livewire:secrets-table/>
    @endif

    <livewire:add-secret-modal/>
@endsection

@push('scripts')
    @vite(['resources/js/home.js'])
@endpush

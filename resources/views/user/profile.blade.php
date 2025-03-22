@extends('layouts.dashboard')

@section('title', __('profile.title'))

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-8 border border-blue-800 mb-8">
            <div class="flex items-center">
                <div class="w-20 h-20 rounded-full bg-blue-500 bg-opacity-20 flex items-center justify-center">
                    <i class="fas fa-user text-3xl text-blue-400"></i>
                </div>
                <div class="ml-6 flex flex-col space-y-2">
                    <h2 class="text-white text-2xl font-bold">{{ $user->name }}</h2>
                    <p class="text-gray-300">{{ $user->email }}</p>
                    <p class="text-gray-400 text-sm">
                        {{ __('profile.member_from') }} {{ $user->created_at->format('d/m/Y') }}
                    </p>
                    <span
                        class="w-fit px-2 py-1 text-xs rounded-full {{ $user->isSsoUser() ? 'bg-indigo-500/20 text-indigo-300' : 'bg-blue-500/20 text-blue-300' }}">
                    {{ $user->isSsoUser() ? __('profile.account_sso') : __('profile.account_local') }}
                </span>
                </div>
            </div>
        </div>

        <livewire:notification-preferences/>

        @if(!$user->isSsoUser())
            <livewire:update-password-form/>

            <livewire:two-factor-auth-form/>

            <livewire:browser-sessions-manager/>
        @endif

        <livewire:delete-user-form/>
    </div>

    @push('scripts')
        @vite('resources/js/user/profile.js')
    @endpush
@endsection

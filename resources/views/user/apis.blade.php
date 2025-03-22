@extends('layouts.dashboard')

@section('title', __('api.title'))

@section('content')
    <div class="space-y-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-key text-blue-400 text-2xl mr-3"></i>
                <h1 class="text-white text-2xl font-bold">{{ __('api.title') }}</h1>
            </div>
            <livewire:create-api-token/>
        </div>

        <livewire:list-api-tokens/>
    </div>
@endsection

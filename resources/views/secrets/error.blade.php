@extends('layouts.secret')

@section('title', $title)
@section('subtitle', $message)

@section('icon')
    @switch($type)
        @case('not_found')
            <i class="fa-solid fa-question-circle text-yellow-400 text-3xl"></i>
            @break
        @case('expired')
            <i class="fa-solid fa-clock text-red-400 text-3xl"></i>
            @break
        @case('max_views')
            <i class="fa-solid fa-eye-slash text-blue-400 text-3xl"></i>
            @break
    @endswitch
@endsection

@section('content')
    <div class="flex flex-col items-center">
        @if($type === 'expired' && isset($expiredAt))
            <p class="text-sm text-gray-400 mb-6">
                {{ __('secrets.error.expired_at') }} : {{ $expiredAt->format('d/m/Y à H:i') }}
            </p>
        @endif

        <a href="{{ route('home') }}"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition-colors duration-300">
            {{ __('button.return_home') }}
        </a>
    </div>
@endsection

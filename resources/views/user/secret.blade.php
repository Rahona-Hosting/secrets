@extends('layouts.dashboard')

@section('title', 'Secret #' . $secret->url)

@section('content')
    <div class="mb-8">
        <a href="{{ route('home') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-500 bg-opacity-20 hover:bg-opacity-30 border border-blue-400 rounded-lg text-blue-300 hover:text-blue-200 transition-all duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            {{ __('button.return_home') }}
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="space-y-8">
            <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-6 border border-blue-800 mb-8">
                <h2 class="text-white text-xl font-bold mb-4"><i class="fa-solid text-blue-400 fa-circle-info"></i>
                    {{ __('secret.title') }}
                </h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-400 text-sm">{{ __('secret.created_at') }}</p>
                        <p class="text-white">{{ $secret->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">{{ __('secret.expire_at') }}</p>
                        <p class="text-white">{{ $secret->expires_at?->format('d M Y, H:i') ?? 'Jamais' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">{{ __('secret.viewed_number') }}</p>
                        <p class="text-white">
                            @php
                                $viewCount = $secret->access()->where('secret_viewed', true)->count();
                            @endphp
                            {{ $viewCount }}/{{ $secret->max_views ?? '∞' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">{{ __('secret.remaining_time') }}</p>
                        @if($secret->remainingViews() > 0 && $remainingTime && !$secret->isExpired())
                            <p class="text-green-400" data-countdown="{{ $secret->expires_at }}"></p>
                        @else
                            <p class="text-gray-400">-</p>
                        @endif
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">{{ __('secret.status') }}</p>
                        @php
                            $hasBeenViewed = $secret->access()->where('secret_viewed', true)->exists();
                            $status = match(true) {
                                $hasBeenViewed => ['text' => __('secret.viewed'), 'color' => 'text-blue-400'],
                                $secret->isExpired() => ['text' => __('secret.expired'), 'color' => 'text-red-400'],
                                $secret->isViewable() => ['text' => __('secret.viewable'), 'color' => 'text-green-400'],
                                default => ['text' => __('secret.inactive'), 'color' => 'text-gray-400']
                            };
                        @endphp
                        <p class="{{ $status['color'] }}">
                            <i class="fas fa-circle text-xs mr-1"></i>
                            {{ $status['text'] }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-6 border border-blue-800 mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-white text-xl font-bold"><i class="fa-solid text-blue-400 fa-link"></i>
                        {{ __('secret.share_url') }}
                    </h2>
                </div>
                <div class="flex items-center space-x-2">
                    <input type="text"
                           id="share-url"
                           value="{{ route('public.secret', $secret->url) }}"
                           class="flex-1 bg-blue-900 bg-opacity-10 border border-blue-800 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-blue-500"
                           readonly>
                    <button
                        type="button"
                        id="copy-button"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-lg transition-colors duration-300">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>

            <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-6 border border-blue-800 mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-white text-xl font-bold"><i class="fa-solid text-blue-400 fa-key"></i>
                        {{ __('secret.view_secret') }}
                    </h2>
                </div>

                @if($secret->data === null)
                    <div class="bg-blue-900 bg-opacity-10 border border-blue-800 rounded-lg py-3 px-4">
                        <p class="text-white">
                            <i class="fas fa-trash-alt mr-2"></i>
                            {{ __('secret.secret_deleted') }}
                        </p>
                    </div>
                @elseif($secret->isE2EE)
                    <div class="space-y-3">
                        <div class="bg-blue-900 bg-opacity-10 border border-blue-800 rounded-lg py-3 px-4">
                            <p class="text-white">
                                <i class="fas fa-lock mr-2"></i>
                                {{ __('secret.secret_e2ee') }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="password"
                                   id="secret-content"
                                   value="{{ $secret->data }}"
                                   class="hidden flex-1 bg-blue-900 bg-opacity-10 border border-blue-800 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-blue-500"
                                   readonly>
                            <input type="password"
                                   id="decrypt-password"
                                   placeholder="{{ __('secret.secret_e2ee_placeholder') }}"
                                   class="flex-1 bg-blue-900 bg-opacity-10 border border-blue-800 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-blue-500">
                            <button
                                type="button"
                                id="decrypt-button"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-lg transition-colors duration-300">
                                <i class="fas fa-unlock-alt"></i>
                            </button>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-2">
                        <input type="password"
                               id="secret-content"
                               value="{{ $secret->data }}"
                               class="flex-1 bg-blue-900 bg-opacity-10 border border-blue-800 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-blue-500"
                               readonly>
                        <button
                            type="button"
                            class="toggle-password bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-lg transition-colors duration-300">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-6 border border-blue-800 mb-8">
                <h2 class="text-white text-xl font-bold mb-4"><i class="fa-solid text-blue-400 fa-chart-simple"></i>
                    {{ __('secret.stats') }}
                </h2>
                <div class="space-y-4">
                    <div>
                        <p class="text-gray-400 text-sm">{{ __('secret.attempts') }}</p>
                        <p class="text-white text-2xl font-bold">{{ $stats['total_attempts'] }}</p>
                    </div>
                    @if($stats['last_attempt'])
                        <div>
                            <p class="text-gray-400 text-sm">{{ __('secret.last_attempt') }}</p>
                            <p class="text-white">{{ $stats['last_attempt']->diffForHumans() }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-6 border border-blue-800">
                <h2 class="text-white text-xl font-bold mb-4">
                    <i class="fas text-blue-400 fa-history mr-2"></i>{{ __('secret.log') }}
                </h2>
                <div class="space-y-4">
                    @foreach($accesses as $access)
                        <div class="@if(!$access->secret_viewed && !$access->password_correct && !$access->password_incorrect)
                        bg-gray-800 bg-opacity-30 border border-gray-700
                    @elseif($secret->isE2EE)
                        @if($access->password_correct)
                            bg-green-500 bg-opacity-10 border border-green-800
                        @elseif($access->password_incorrect)
                            bg-red-500 bg-opacity-10 border border-red-800
                        @elseif($access->secret_viewed)
                            bg-blue-500 bg-opacity-10 border border-blue-800
                        @endif
                    @else
                        @if($access->secret_viewed)
                            bg-green-500 bg-opacity-10 border border-green-800
                        @endif
                    @endif rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="@if(!$access->secret_viewed && !$access->password_correct && !$access->password_incorrect)
                                    text-gray-300
                                @elseif($secret->isE2EE)
                                    @if($access->password_correct)
                                        text-green-400
                                    @elseif($access->password_incorrect)
                                        text-red-400
                                    @elseif($access->secret_viewed)
                                        text-blue-400
                                    @endif
                                @else
                                    @if($access->secret_viewed)
                                        text-green-400
                                    @endif
                                @endif font-semibold flex items-center">

                                        @if(!$access->secret_viewed && !$access->password_correct && !$access->password_incorrect)
                                            <i class="fas fa-clock mr-2"></i>{{ __('secret.log_try') }}
                                        @elseif($secret->isE2EE)
                                            @if($access->password_correct)
                                                <i class="fas fa-lock-open mr-2"></i>{{ __('secret.log_decrypted_success') }}
                                            @elseif($access->password_incorrect)
                                                <i class="fas fa-lock mr-2"></i>{{ __('secret.log_decrypted_failed') }}
                                            @elseif($access->secret_viewed)
                                                <i class="fas fa-shield-alt mr-2"></i>{{ __('secret.log_encrypted_text_send_to_client') }}
                                            @endif
                                        @else
                                            @if($access->secret_viewed)
                                                <i class="fas fa-eye mr-2"></i>{{ __('secret.secret_view') }}
                                            @endif
                                        @endif
                                    </p>
                                    <p class="text-gray-400 text-sm flex items-center">
                                        <i class="fas fa-network-wired mr-2"></i>{{ $access->ip }}
                                    </p>
                                </div>
                                <span class="text-gray-400 text-sm flex items-center">
                        <i class="far fa-clock mr-2"></i>{{ $access->created_at->diffForHumans() }}
                    </span>
                            </div>
                            <div class="mt-2 text-sm text-gray-400 flex items-center">
                                <i class="fas fa-browser mr-2"></i>
                                <p>{{ $access->user_agent }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/user/secret.js', 'resources/js/secret/decrypt.js'])
@endpush

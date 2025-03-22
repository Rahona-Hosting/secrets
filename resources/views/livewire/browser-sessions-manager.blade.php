<div>
    <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-8 border border-blue-800 mb-8">
        <h3 class="text-white text-xl font-bold mb-4">
            <i class="fas fa-globe mr-2 text-blue-400"></i>
            {{ __('browser-manager.sessions') }}
        </h3>

        <p class="text-gray-300 mb-6">
            {{ __('browser-manager.subtitle') }}
        </p>

        <div class="space-y-6">
            @foreach($sessions as $session)
                <div
                    class="flex items-center justify-between p-4 bg-blue-900 bg-opacity-10 rounded-lg border border-blue-800">
                    <div class="flex items-center">
                        <div class="text-gray-300">
                            <div class="text-sm font-semibold">
                                {{ Str::limit($session->agent, 50) }}
                            </div>
                            <div class="text-xs">
                                {{ $session->ip }}
                            </div>
                            <div class="text-xs text-gray-400">
                                {{ __('browser-manager.last_activity') }} {{ $session->lastActive }}
                            </div>
                        </div>
                    </div>
                    @if($session->isCurrentDevice)
                        <span class="px-3 py-1 text-xs text-green-400 bg-green-400 bg-opacity-10 rounded-full">
                            {{ __('browser-manager.current_device') }}
                        </span>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            <a href="{{ route('user.logoutOtherBrowserSessions') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transform transition-all duration-300 hover:scale-105">
                {{ __('browser-manager.disconnect_all') }}
            </a>
        </div>
    </div>
</div>

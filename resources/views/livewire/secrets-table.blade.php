<div>
    <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-4 mb-6 border border-blue-800">
        <div class="flex flex-wrap gap-4">
            <button wire:click="setFilter('all')"
                    class="@if($filter === 'all') bg-blue-500 @else bg-blue-900 bg-opacity-50 hover:bg-blue-800 @endif text-white px-4 py-2 rounded-lg">
                {{ __('secrets.table.all') }}
            </button>
            <button wire:click="setFilter('active')"
                    class="@if($filter === 'active') bg-blue-500 @else bg-blue-900 bg-opacity-50 hover:bg-blue-800 @endif text-gray-300 px-4 py-2 rounded-lg">
                {{ __('secrets.table.active') }}
            </button>
            <button wire:click="setFilter('viewed')"
                    class="@if($filter === 'viewed') bg-blue-500 @else bg-blue-900 bg-opacity-50 hover:bg-blue-800 @endif text-gray-300 px-4 py-2 rounded-lg">
                {{ __('secrets.table.viewed') }}
            </button>
            <button wire:click="setFilter('expired')"
                    class="@if($filter === 'expired') bg-blue-500 @else bg-blue-900 bg-opacity-50 hover:bg-blue-800 @endif text-gray-300 px-4 py-2 rounded-lg">
                {{ __('secrets.table.expired') }}
            </button>
        </div>
    </div>

    <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl border border-blue-800 overflow-hidden">
        <table class="w-full">
            <thead>
            <tr class="bg-blue-900 bg-opacity-50">
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">{{ __('secrets.table.id') }}</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">{{ __('secrets.table.created_at') }}</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">{{ __('secrets.table.expired_at') }}</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">{{ __('secrets.table.status') }}</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">{{ __('secrets.table.actions') }}</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-blue-800">
            @forelse($secrets as $secret)
                <tr class="hover:bg-blue-900 hover:bg-opacity-20">
                    <td class="px-6 py-4 text-gray-300">#{{ $secret->id }}</td>
                    <td class="px-6 py-4 text-gray-300">{{ $secret->created_at->format('Y-m-d H:i') }}</td>
                    <td class="px-6 py-4 text-gray-300">{{ $secret->expires_at ? $secret->expires_at->format('Y-m-d H:i') : 'Jamais' }}</td>
                    <td class="px-6 py-4">
                        @php
                            $viewCount = $secret->view_count;
                            $maxViews = $secret->max_views ?? '∞';
                            $hasBeenViewed = $viewCount > 0;
                        @endphp

                        @if($secret->isExpired() && !$hasBeenViewed)
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full bg-red-500 bg-opacity-20 text-red-400">
                                {{ __('secrets.expired') }}
                            </span>
                        @elseif($hasBeenViewed)
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-500 bg-opacity-20 text-purple-400">
                                {{ __('secrets.viewed') }} ({{ $viewCount }}/{{ $maxViews }})
                            </span>
                        @else
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full bg-green-500 bg-opacity-20 text-green-400">
                                {{ __('secrets.active') }} ({{ $viewCount }}/{{ $maxViews }})
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('user.secret', $secret) }}" class="text-blue-400 hover:text-blue-300 mr-3">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button wire:click="confirmSecretDeletion({{ $secret->id }})"
                                class="text-red-400 hover:text-red-300">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-400">
                        {{ __('secrets.no_secrets') }}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $secrets->links() }}
        </div>
    </div>

    @if($confirmingSecretDeletion)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <div class="relative bg-gray-900 rounded-lg p-8 max-w-md w-full mx-4 border border-blue-800">
                <div class="mb-6 text-center">
                    <div
                        class="w-16 h-16 bg-red-500 bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exclamation-triangle text-2xl text-red-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">
                        {{ __('secrets.delete.title') }}
                    </h3>
                    <p class="text-gray-400">
                        {{ __('secrets.delete.warning') }}
                    </p>
                </div>
                <div class="flex justify-center space-x-4">
                    <button
                        wire:click="cancelSecretDeletion"
                        class="px-4 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors duration-200"
                    >
                        {{ __('button.cancel') }}
                    </button>
                    <button
                        wire:click="deleteSecret"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200"
                    >
                        {{ __('button.delete') }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

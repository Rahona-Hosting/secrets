<div>
    <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl border border-blue-800 overflow-hidden mb-8">
        <div class="p-6 border-b border-blue-800">
            <h2 class="text-white text-xl font-bold">{{ __('api.list.title') }}</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                <tr class="bg-blue-900 bg-opacity-50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">
                        {{ __('api.list.name') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">
                        {{ __('api.list.last_usage') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">
                        {{ __('api.list.created_at') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">
                        {{ __('api.list.expire_at') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">
                        {{ __('api.list.status') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">
                        {{ __('api.list.actions') }}
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-blue-800">
                @forelse($tokens as $token)
                    <tr class="hover:bg-blue-900 hover:bg-opacity-20">
                        <td class="px-6 py-4 text-gray-300">{{ $token->name }}</td>
                        <td class="px-6 py-4 text-gray-300">
                            {{ $token->last_used_at ? $token->last_used_at->diffForHumans() : __('api.list.never_used') }}
                        </td>
                        <td class="px-6 py-4 text-gray-300">
                            {{ $token->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 text-gray-300">
                            {{ $token->expires_at ? $token->expires_at->format('d/m/Y H:i') : __('api.list.never_expire') }}
                        </td>
                        <td class="px-6 py-4">
                            @if(!$token->expires_at || $token->expires_at->isFuture())
                                <span class="px-2 py-1 text-xs rounded-full bg-green-500 bg-opacity-20 text-green-400">
                                {{ __('api.list.active') }}
                            </span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-red-500 bg-opacity-20 text-red-400">
                                {{ __('api.list.expired') }}
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-red-400 hover:text-red-300"
                                    wire:click="confirmTokenDeletion({{ $token->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-300">
                            {{ __('api.list.empty') }}
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-blue-800">
            {{ $tokens->links() }}
        </div>
    </div>

    @if($confirmingTokenDeletion)
        <div class="fixed inset-0 bg-black bg-opacity-50 modal flex items-center justify-center z-[100]">
            <div class="bg-gray-900 rounded-xl p-8 max-w-md w-full mx-4 border border-blue-800">
                <div class="text-center mb-6">
                    <i class="fas fa-exclamation-triangle text-red-400 text-4xl mb-4"></i>
                    <h3 class="text-xl font-bold text-white">{{ __('api.delete.title') }}</h3>
                    <p class="text-gray-300 text-sm mt-2">
                        {{ __('api.delete.message') }}
                    </p>
                </div>

                <div class="flex justify-center space-x-4">
                    <button wire:click="deleteToken"
                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        <i class="fas fa-trash"></i> {{ __('button.confirm') }}
                    </button>
                    <button wire:click="$set('confirmingTokenDeletion', false)"
                            class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600">
                        {{ __('button.cancel') }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

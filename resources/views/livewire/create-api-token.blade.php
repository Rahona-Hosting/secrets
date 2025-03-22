<div>
    <button wire:click="open"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center transition-all duration-300">
        <i class="fas fa-plus mr-2"></i>
        {{ __('api.addBtn') }}
    </button>

    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 modal flex items-center justify-center z-[10]">
            <div class="bg-gray-900 rounded-xl p-8 max-w-md w-full mx-4 border border-blue-800">
                @if(!$newToken)
                    <div class="text-center mb-6">
                        <i class="fas fa-key text-blue-400 text-4xl mb-4"></i>
                        <h3 class="text-xl font-bold text-white">{{ __('api.add.title') }}</h3>
                    </div>

                    <form wire:submit="createToken">
                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">{{ __('api.add.name') }}</label>
                            <input type="text"
                                   wire:model="tokenName"
                                   class="w-full bg-blue-900 bg-opacity-20 border border-blue-800 rounded-lg px-4 py-2 text-white"
                                   placeholder="{{ __('api.add.placeholder') }}">
                            @error('tokenName')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">{{ __('api.add.expireDate') }}</label>
                            <input
                                type="text"
                                wire:model="expirationDate"
                                class="datepicker w-full bg-blue-900 bg-opacity-20 border border-blue-800 rounded-lg px-4 py-2 text-white">
                            @error('expirationDate')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-4">
                            <button type="button"
                                    wire:click="closeModal"
                                    class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600">
                                {{ __('button.cancel') }}
                            </button>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                <i class="fa-solid fa-floppy-disk"></i> {{ __('button.save') }}
                            </button>
                        </div>
                    </form>
                @else
                    <div class="text-center mb-6">
                        <i class="fas fa-key text-blue-400 text-4xl mb-4"></i>
                        <h3 class="text-xl font-bold text-white">{{ __('api.add.success') }}</h3>
                        <p class="text-gray-300 text-sm mt-2">
                            {{ __('api.add.warning') }}
                        </p>
                    </div>

                    <div class="bg-blue-900 bg-opacity-20 rounded-lg p-4 mb-6">
                        <p class="text-yellow-400 font-mono break-all" x-ref="tokenDisplay">
                            {{ $newToken }}
                        </p>
                    </div>

                    <div class="flex justify-center space-x-4">
                        <button onclick="navigator.clipboard.writeText('{{ $newToken }}')"
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 flex items-center">
                            <i class="fas fa-copy mr-2"></i>
                            {{ __('button.copy') }}
                        </button>
                        <button wire:click="closeModal"
                                class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600">
                            {{ __('button.clore') }}
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @endif

    @vite(['resources/js/calendar.js'])
</div>

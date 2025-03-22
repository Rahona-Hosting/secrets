<div id="secret-viewer">
    @if($isDestroyed)
        <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-8 shadow-2xl text-center">
            <i class="fa-solid fa-check-circle text-blue-400 text-6xl mb-4 block"></i>
            <h2 class="text-2xl font-bold text-white mb-2">{{ __('secret.view.destroyed') }}</h2>
            <p class="text-gray-300">{{ __('secret.view.destroyed_explanation') }}</p>
        </div>
    @else
        <div class="bg-blue-900 bg-opacity-20 rounded-lg p-4 mb-6 border border-blue-800">
            <div class="flex items-start">
                <i class="fa-solid fa-exclamation-circle text-blue-400 mt-1 mr-3"></i>
                <div class="text-sm text-gray-200">
                    <p class="font-semibold mb-1">{{ __('secret.view.important') }}</p>
                    <ul class="list-disc list-inside space-y-1">
                        <li>
                            @if($secret->max_views === 1)
                                {{ __('secret.view.one_time') }}
                            @else
                                {{ __('secret.view.max_view', ['max' => $secret->max_views]) }}
                            @endif
                        </li>
                        @if($secret->expires_at)
                            <li>
                                {{ __('secret.view.removed_at', ['expire_at' => $secret->expires_at]) }}
                            </li>
                        @endif
                        <li>
                            {{ __('secret.view.be_ready') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @if(!$isRevealed)
            <div class="space-y-4">
                <button wire:click="revealSecret"
                        class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 px-6 rounded-lg transform transition-all duration-300 hover:scale-105 flex items-center justify-center">
                    <i class="fa-solid fa-eye mr-2"></i>
                    {{ __('secret.view.see_button') }}
                </button>
            </div>
        @else
            @if($secret->isE2EE)
                <div class="bg-blue-900 bg-opacity-10 border border-blue-800 rounded-lg p-4 mb-6">
                    <div class="flex flex-col space-y-4">
                        <input type="password"
                               id="secret-content"
                               value="{{ $secret->data }}"
                               class="hidden bg-blue-900 bg-opacity-10 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-blue-500 border-none"
                               readonly>

                        <input type="password"
                               id="decrypt-password"
                               placeholder="{{ __('secret.view.e2ee_password') }}"
                               class="w-full bg-blue-900 bg-opacity-10 border border-blue-800 rounded-lg py-3 px-4 text-white focus:outline-none focus:border-blue-500">

                        <button type="button"
                                id="decrypt-button"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition-colors duration-300 flex items-center justify-center">
                            <i class="fas fa-unlock-alt mr-2"></i>
                            {{ __('secret.view.decrypt_password') }}
                        </button>
                    </div>
                </div>
            @else
                <div class="bg-blue-900 bg-opacity-10 rounded-lg p-4 mb-6 border border-blue-800">
                    <p class="text-white text-center">
                        {{ $secret->data }}
                    </p>
                </div>
            @endif


            <div class="space-y-4">
                <button wire:click="closeSecret"
                    @class([
                        'w-full font-bold py-3 px-6 rounded-lg transform transition-all duration-300 hover:scale-105 flex items-center justify-center',
                        'bg-red-800 hover:bg-red-700 text-white' => $this->isLastView,
                        'bg-gray-800 hover:bg-gray-700 text-white' => !$this->isLastView,
                    ])>
                    <i class="fa-solid fa-times mr-2"></i>
                    @if($this->isLastView)
                        {{ __('secret.view.close_and_destroy') }}
                    @else
                        {{ __('button.clore') }}
                    @endif
                </button>
            </div>
        @endif
    @endif

    @vite(['resources/js/secret/unlock.js', 'resources/js/secret/decrypt.js'])
</div>

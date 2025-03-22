<div>
    <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-8 border border-red-800">
        <h3 class="text-white text-xl font-bold mb-4">
            <i class="fas fa-exclamation-triangle mr-2 text-red-400"></i>
            {{ __('profile.delete.title') }}
        </h3>
        <p class="text-gray-300 mb-6">
            {{ __('profile.delete.warning') }}
        </p>
        <button wire:click="confirmUserDeletion"
                class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg transform transition-all duration-300 hover:scale-105">
            {{ __('profile.delete.button') }}
        </button>
    </div>

    @if($showDeleteModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 modal flex items-center justify-center">
            <div class="bg-gray-900 rounded-xl p-8 max-w-md w-full mx-4 border border-red-800">
                <div class="text-center">
                    <i class="fas fa-exclamation-circle text-red-400 text-5xl mb-4"></i>
                    <h3 class="text-xl font-bold text-white mb-4">{{ __('profile.delete.confirm.title') }}</h3>
                    <p class="text-gray-300 mb-6">
                        {{ __('profile.delete.confirm.warning') }}
                    </p>

                    <div class="space-y-4">
                        <div class="input-group">
                            <label
                                class="block text-gray-300 text-sm font-bold mb-2">{{ __('profile.delete.confirm.text') }}</label>
                            <input type="text"
                                   wire:model="confirmationText"
                                   class="w-full bg-blue-900 bg-opacity-10 border border-red-800 rounded-lg py-3 px-4 text-white placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500"
                                   placeholder="{{ __('profile.delete.confirm.text_placeholder') }}">
                        </div>
                        <div class="flex justify-center space-x-4">
                            <button wire:click="$set('showDeleteModal', false)"
                                    class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600">
                                {{ __('button.cancel') }}
                            </button>
                            <button wire:click="deleteUser"
                                    class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                {{ __('profile.delete.confirm.button') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

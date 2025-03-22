<div>
    <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-8 border border-blue-800 mb-8">
        <h3 class="text-white text-xl font-bold mb-4">
            <i class="fas fa-bell mr-2 text-blue-400"></i>
            {{ __('profile.notifications.title') }}
        </h3>

        <p class="text-gray-300 mb-6">
            {{ __('profile.notifications.subtitle') }}
        </p>

        <div class="space-y-6">
            <div class="flex items-center">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox"
                           wire:model.live="notify_api_token_expiring"
                           class="sr-only peer">
                    <div
                        class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
                <span class="ms-3 text-gray-300">{{ __('profile.notifications.token_expiration') }}</span>
            </div>

            <div class="flex items-center">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox"
                           wire:model.live="notify_secret_expired"
                           class="sr-only peer">
                    <div
                        class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
                <span class="ms-3 text-gray-300">{{ __('profile.notifications.secret_expired') }}</span>
            </div>

            <div class="flex items-center">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox"
                           wire:model.live="notify_secret_accessed"
                           class="sr-only peer">
                    <div
                        class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
                <span class="ms-3 text-gray-300">{{ __('profile.notifications.secret_access') }}</span>
            </div>
        </div>
    </div>
</div>

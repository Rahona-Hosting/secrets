<div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-8 border border-blue-800 mb-8">
    <h3 class="text-white text-xl font-bold mb-6">
        <i class="fas fa-lock mr-2 text-blue-400"></i>
        {{ __('profile.password.title') }}
    </h3>

    <form wire:submit="updatePassword" class="space-y-6">
        <div class="input-group">
            <label
                class="block text-gray-300 text-sm font-bold mb-2">{{ __('profile.password.current_password') }}</label>
            <div class="relative">
                <i class="fas fa-key absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="password"
                       wire:model="current_password"
                       class="w-full bg-blue-900 bg-opacity-10 border border-blue-800 rounded-lg py-3 px-10 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                       placeholder="••••••••">
            </div>
            @error('current_password') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="input-group">
            <label class="block text-gray-300 text-sm font-bold mb-2">{{ __('profile.password.new_password') }}</label>
            <div class="relative">
                <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="password"
                       wire:model="password"
                       class="w-full bg-blue-900 bg-opacity-10 border border-blue-800 rounded-lg py-3 px-10 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                       placeholder="••••••••">
            </div>
            @error('password') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="input-group">
            <label
                class="block text-gray-300 text-sm font-bold mb-2">{{ __('profile.password.confirm_password') }}</label>
            <div class="relative">
                <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="password"
                       wire:model="password_confirmation"
                       class="w-full bg-blue-900 bg-opacity-10 border border-blue-800 rounded-lg py-3 px-10 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                       placeholder="••••••••">
            </div>
        </div>

        <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transform transition-all duration-300 hover:scale-105">
            {{ __('profile.password.button') }}
        </button>
    </form>
</div>

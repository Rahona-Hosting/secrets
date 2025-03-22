<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-6 border border-blue-800">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-500 bg-opacity-20">
                <i class="fas fa-key text-blue-400"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-gray-300 text-sm">{{ __('secrets.stats.active') }}</h2>
                <p class="text-white text-2xl font-bold">{{ $stats['active'] }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-6 border border-blue-800">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-500 bg-opacity-20">
                <i class="fas fa-check text-green-400"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-gray-300 text-sm">{{ __('secrets.stats.shared') }}</h2>
                <p class="text-white text-2xl font-bold">{{ $stats['shared'] }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-6 border border-blue-800">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-500 bg-opacity-20">
                <i class="fas fa-clock text-red-400"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-gray-300 text-sm">{{ __('secrets.stats.expired') }}</h2>
                <p class="text-white text-2xl font-bold">{{ $stats['expired'] }}</p>
            </div>
        </div>
    </div>
</div>

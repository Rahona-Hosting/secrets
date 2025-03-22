<button
    wire:click="openModal"
    class="flex items-center space-x-2 px-3 py-2 text-gray-300 hover:text-blue-400 transition-colors duration-200"
>
    <span class="fi fi-{{ $languages[$currentLocale]['flag'] }}"></span>
    <span class="text-sm">{{ $languages[$currentLocale]['native'] }}</span>
</button>

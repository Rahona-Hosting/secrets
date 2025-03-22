<footer class="w-full bg-white bg-opacity-5 backdrop-blur-lg border-t border-blue-800">
    <div class="container mx-auto px-4 py-3">
        <div class="flex flex-col md:flex-row justify-center items-center space-y-2 md:space-y-0 md:space-x-4">
            <livewire:language-selector-button/>
            <div class="text-gray-300 text-sm flex items-center">
                {{ config('app.name') }}
                {{ __('messages.made_with') }} <i class="fas fa-heart text-red-500 mx-2"></i> {{ __('messages.by') }}
                <a href="https://rahona-hosting.com"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="text-blue-400 hover:text-blue-300 ml-1">
                    Rahona Hosting
                </a>
            </div>
            <div class="flex items-center">
                <a class="github-button"
                   href="https://github.com/Rahona-Hosting/secrets"
                   data-color-scheme="no-preference: light; light: light; dark: light;"
                   data-size="large"
                   data-show-count="true"
                   aria-label="Star Rahona-Hosting/secrets on GitHub">
                    Star
                </a>
            </div>
        </div>
    </div>
</footer>
<script async defer src="https://buttons.github.io/buttons.js"></script>

<livewire:language-selector-modal/>

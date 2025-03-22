<div>
    @if($show)
        <div class="fixed inset-0 bg-gray-900/90 z-[100]"></div>

        <div class="fixed inset-0 z-[100] overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-gray-800 px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                    <div>
                        <div class="mt-3 text-center">
                            <h3 class="text-2xl font-semibold leading-6 text-white mb-4">
                                {{ __('messages.select_language') }}
                            </h3>

                            <div class="space-y-2">
                                @foreach($languages as $locale => $language)
                                    <button
                                        wire:click="switchLanguage('{{ $locale }}')"
                                        class="flex items-center justify-between w-full px-4 py-3 text-gray-300 rounded-lg {{ $locale === $currentLocale ? 'bg-blue-600' : 'hover:bg-gray-700' }}"
                                    >
                                        <div class="flex items-center space-x-3">
                                            <span class="fi fi-{{ $language['flag'] }}"></span>
                                            <span>{{ $language['name'] }}</span>
                                        </div>
                                        @if($locale === $currentLocale)
                                            <i class="fas fa-check text-blue-400"></i>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 sm:mt-6">
                        <button
                            type="button"
                            wire:click="$set('show', false)"
                            class="inline-flex w-full justify-center rounded-md bg-gray-700 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-600 hover:bg-gray-600">
                            {{ __('button.clore') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

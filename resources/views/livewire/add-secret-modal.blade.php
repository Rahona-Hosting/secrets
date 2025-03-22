<div>
    @if($show)
        <div class="fixed inset-0 bg-gray-900/90 z-10"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-gray-800 px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-2xl font-semibold leading-6 text-white">
                                {{ __('secret.add.title') }}
                            </h3>

                            @if(!$createdSecretUrl)
                                <div class="mt-4">
                                    <div class="space-y-4">
                                        <!-- Switch E2EE -->
                                        <div class="flex items-center justify-between">
                                            <span class="flex flex-grow flex-col">
                                                <span
                                                    class="text-sm font-medium leading-6 text-white">{{ __('secret.add.e2ee') }}</span>
                                                <span
                                                    class="text-sm text-gray-400">{{ __('secret.add.e2ee_explain') }}</span>
                                            </span>
                                            <button
                                                type="button"
                                                wire:click="$toggle('isE2EE')"
                                                class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 {{ $isE2EE ? 'bg-blue-600' : 'bg-gray-700' }}"
                                                role="switch"
                                                aria-checked="{{ $isE2EE ? 'true' : 'false' }}">
                                                <span
                                                    aria-hidden="true"
                                                    class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $isE2EE ? 'translate-x-5' : 'translate-x-0' }}"></span>
                                            </button>
                                        </div>

                                        @if($isE2EE)
                                            <div class="mb-4">
                                                <label for="password"
                                                       class="block text-sm font-medium text-gray-300">{{ __('secret.add.e2ee_password') }}</label>
                                                <div class="relative">
                                                    <input
                                                        type="password"
                                                        id="e2eePassword"
                                                        placeholder="{{ __('secret.add.e2ee_password_placeholder') }}"
                                                        class="mt-1 block w-full rounded-md border-gray-700 bg-gray-700 text-white pr-10 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                    <button
                                                        type="button"
                                                        onclick="togglePasswordVisibility()"
                                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-300">
                                                        <i id="passwordToggleIcon" class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif

                                        <div>
                                            <label for="secret"
                                                   class="block text-sm font-medium text-gray-300">{{ __('secret.add.secret') }}</label>
                                            <textarea
                                                id="tmpSecret"
                                                rows="4"
                                                class="mt-1 block w-full rounded-md border-gray-700 bg-gray-700 text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                placeholder="{{ __('secret.add.secret_placeholder') }}"></textarea>
                                            <input type="hidden" wire:model="secret">
                                            @error('secret')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="max_views"
                                                   class="block text-sm font-medium text-gray-300">{{ __('secret.add.max_view') }}</label>
                                            <input
                                                type="number"
                                                wire:model="max_views"
                                                class="mt-1 block w-full rounded-md border-gray-700 bg-gray-700 text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            @error('max_views')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="expiresAt" class="block text-sm font-medium text-gray-300">
                                                {{ __('secret.add.expire_date') }}
                                            </label>
                                            <input
                                                type="text"
                                                wire:model="expiresAt"
                                                class="datepicker mt-1 block w-full rounded-md border-gray-700 bg-gray-700 text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            @error('expiresAt')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="mt-4">
                                    <p class="text-sm text-gray-300 mb-4">
                                        {{ __('secret.add.success_message') }}
                                    </p>
                                    <div class="flex items-center gap-2">
                                        <input
                                            type="text"
                                            readonly
                                            value="{{ $createdSecretUrl }}"
                                            class="block w-full rounded-md border-gray-700 bg-gray-700 text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <button
                                            x-data
                                            x-on:click="navigator.clipboard.writeText('{{ $createdSecretUrl }}').then(() => $wire.copyUrl())"
                                            type="button"
                                            class="rounded-md bg-gray-700 p-2 text-gray-400 hover:text-gray-300">
                                            <i class="fas {{ $urlCopied ? 'fa-check' : 'fa-copy' }} w-5 h-5"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                        @if(!$createdSecretUrl)
                            <button
                                type="button"
                                wire:click="createSecret"
                                class="inline-flex w-full items-center justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 sm:col-start-2">
                                <i class="fa-solid fa-floppy-disk mr-2"></i> {{ __('secret.add.btn_add') }}
                            </button>
                        @else
                            <button
                                type="button"
                                wire:click="open"
                                class="inline-flex w-full items-center justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 sm:col-start-2">
                                <i class="fa-solid fa-pen mr-2"></i> {{ __('secret.add.btn_add_another_secret') }}
                            </button>
                        @endif
                        <button
                            type="button"
                            wire:click="close"
                            class="mt-3 inline-flex w-full items-center justify-center rounded-md bg-gray-700 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-600 hover:bg-gray-600 sm:col-start-1 sm:mt-0">
                            <i class="fa-solid fa-xmark mr-2"></i> {{ $createdSecretUrl ? __('button.clore') : __('button.cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @vite(['resources/js/secret/encrypt.js', 'resources/js/calendar.js'])
</div>

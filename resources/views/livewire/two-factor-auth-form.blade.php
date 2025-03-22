<div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-8 border border-blue-800 mb-8">
    <h3 class="text-white text-xl font-bold mb-6">
        <i class="fas fa-shield-alt mr-2 text-blue-400"></i>
        {{ __('2fa.title') }}
    </h3>

    @if (session('status') === 'two-factor-authentication-confirmed')
        <div class="bg-green-500 bg-opacity-10 border border-green-500 text-green-400 px-4 py-2 rounded-lg mb-6">
            {{ __('2fa.setup_success') }}
        </div>
    @endif

    @if(!auth()->user()->two_factor_confirmed_at && !auth()->user()->two_factor_secret)
        <div class="mb-6">
            <p class="text-gray-300 mb-4">
                {{ __('2fa.enable_message') }}
            </p>

            <button wire:click="enableTwoFactorAuth"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transform transition-all duration-300 hover:scale-105">
                {{ __('2fa.enable_button') }}
            </button>
        </div>
    @else
        <div class="mb-6">
            @if(!auth()->user()->two_factor_confirmed_at)
                <div class="mb-4">
                    <p class="text-gray-300 mb-4">
                        {{ __('2fa.enable_qr_code') }}
                    </p>
                    <div class="p-4 bg-white rounded-lg inline-block mb-4">
                        {!! auth()->user()->twoFactorQrCodeSvg() !!}
                    </div>
                    <form action="/user/confirmed-two-factor-authentication" method="POST" class="mt-4">
                        @csrf
                        <p class="text-gray-300 mb-2">
                            {{ __('2fa.enable_finish_code') }}
                        </p>

                        <div class="flex items-center gap-4">
                            <input type="text"
                                   name="code"
                                   class="bg-blue-900 bg-opacity-10 border border-blue-800 text-white px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500"
                                   placeholder="{{ __('2fa.enable_finish_code_placeholder') }}">

                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                                {{ __('2fa.confirm') }}
                            </button>
                        </div>

                        @error('code')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            @endif

            @if(auth()->user()->two_factor_confirmed_at && !auth()->user()->two_factor_recovery_codes_downloaded)
                <div class="mb-4">
                    <p class="text-gray-300 mb-4">
                        {{ __('2fa.download_backup') }}
                    </p>

                    <button wire:click="downloadRecoveryCodes"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                        <i class="fas fa-download mr-2"></i>
                        {{ __('2fa.download_backup_button') }}
                    </button>
                </div>
            @endif

            <button wire:click="disableTwoFactorAuth"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">
                {{ __('2fa.disable_button') }}
            </button>
        </div>
    @endif
</div>

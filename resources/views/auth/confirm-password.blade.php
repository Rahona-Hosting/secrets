@extends('layouts.auth')

@section('title', __('auth.confirm_password.title'))
@section('subtitle', __('auth.confirm_password.subtitle'))

@section('content')
    @if ($errors->any())
        <div class="bg-red-500 bg-opacity-10 border border-red-800 text-red-300 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-blue-500 bg-opacity-10 border border-blue-800 text-blue-300 px-4 py-3 rounded-lg mb-6">
        <p class="text-white">
            <i class="fas fa-info-circle mr-2"></i>
            {{ __('auth.confirm_password.message') }}
        </p>
    </div>

    <div class="bg-white bg-opacity-5 backdrop-blur-lg rounded-xl p-8 border border-blue-800 mb-6">
        <form id="confirmPasswordForm" class="space-y-6" action="{{ route('password.confirm') }}" method="POST">
            @csrf

            <div class="input-group">
                <label class="block text-gray-300 text-sm font-bold mb-2">
                    {{ __('auth.confirm_password.password') }}
                </label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="password"
                           name="password"
                           class="w-full bg-blue-900 bg-opacity-10 border @error('password') border-red-500 @else border-blue-800 @enderror rounded-lg py-3 px-10 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                           placeholder="••••••••" required>
                    <button type="button"
                            class="toggle-password absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-300">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <a href="{{ route('user.profile') }}"
                   class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-4 rounded-lg transform transition-all duration-300 hover:scale-105 text-center">
                    <i class="fas fa-times mr-2"></i>
                    {{ __('button.cancel') }}
                </a>
                <button type="submit"
                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transform transition-all duration-300 hover:scale-105">
                    <i class="fas fa-check mr-2"></i>
                    {{ __('button.confirm') }}
                </button>
            </div>
        </form>
    </div>

    <p class="text-center mt-6 text-gray-400">
        {{ __('auth.confirm_password.forgot_password') }}
        <a href="{{ route('password.request') }}" class="text-blue-400 hover:text-blue-300">Réinitialiser</a>
    </p>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function () {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        document.querySelectorAll('.input-group input').forEach(input => {
            input.addEventListener('focus', () => {
                const icon = input.parentElement.querySelector('i:first-child');
                icon.classList.add('text-blue-400');
                icon.classList.remove('text-gray-400');
            });

            input.addEventListener('blur', () => {
                const icon = input.parentElement.querySelector('i:first-child');
                icon.classList.remove('text-blue-400');
                icon.classList.add('text-gray-400');
            });
        });
    </script>
@endpush

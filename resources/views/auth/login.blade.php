<x-guest-layout>
    <!-- Centered Container -->
    <div class="max-w-md mx-auto mt-8 bg-white p-6 rounded shadow">
        <!-- Title -->
        <h1 class="text-3xl font-bold text-center mb-4 text-pink-600">Login</h1>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('E-mail')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    placeholder="e-mail" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    placeholder="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Login Button -->
            <div class="text-center">
                <x-primary-button class="mt-3">
                    {{ __('Login') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Company Sign Up Link -->
        <div class="text-center mt-4">
            Are you a company that offers internship?
            <a href="{{ route('register') }}" class="font-semibold underline">
                Sign Up
            </a>
        </div>
    </div>
</x-guest-layout>

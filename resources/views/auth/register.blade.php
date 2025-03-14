<x-guest-layout>
    <h1 class="text-2xl font-bold mb-4">Informatie over het bedrijf</h1>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- 2-Column Layout for Medium Screens -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column: Account Information -->
            <div class="bg-white p-4 rounded shadow">
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('E-mail')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" placeholder="Placeholder" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Wachtwoord')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" placeholder="Placeholder" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Bevestig wachtwoord')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" placeholder="Placeholder" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <!-- Right Column: Company Details -->
            <div class="bg-white p-4 rounded shadow">
                <!-- Bedrijf Naam -->
                <div>
                    <x-input-label for="company_name" :value="__('Bedrijf naam')" />
                    <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name"
                        :value="old('company_name')" placeholder="Placeholder" />
                    <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                </div>

                <!-- Logo Upload -->
                <div class="mt-4">
                    <x-input-label for="logo" :value="__('Logo')" />
                    <input id="logo" class="block mt-1 w-full" type="file" name="logo" accept="image/*" />
                    @error('logo')
                        <div class="text-red-600 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Row: Straat, Nr, Bus (3 fields side-by-side for md screens) -->
                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <x-input-label for="street" :value="__('Straat')" />
                        <x-text-input id="street" class="block mt-1 w-full" type="text" name="street"
                            :value="old('street')" placeholder="Placeholder" />
                        <x-input-error :messages="$errors->get('street')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="nr" :value="__('Nr')" />
                        <x-text-input id="nr" class="block mt-1 w-full" type="text" name="nr"
                            :value="old('nr')" placeholder="Placeholder" />
                        <x-input-error :messages="$errors->get('nr')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="bus" :value="__('Bus')" />
                        <x-text-input id="bus" class="block mt-1 w-full" type="text" name="bus"
                            :value="old('bus')" placeholder="Placeholder" />
                        <x-input-error :messages="$errors->get('bus')" class="mt-2" />
                    </div>
                </div>

                <!-- Row: Gemeente, Postcode, Land (3 fields side-by-side) -->
                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <x-input-label for="town" :value="__('Gemeente')" />
                        <x-text-input id="town" class="block mt-1 w-full" type="text" name="town"
                            :value="old('town')" placeholder="Placeholder" />
                        <x-input-error :messages="$errors->get('town')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="zip" :value="__('Postcode')" />
                        <x-text-input id="zip" class="block mt-1 w-full" type="text" name="zip"
                            :value="old('zip')" placeholder="Placeholder" />
                        <x-input-error :messages="$errors->get('zip')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="country" :value="__('Land')" />
                        <x-text-input id="country" class="block mt-1 w-full" type="text" name="country"
                            :value="old('country')" placeholder="Placeholder" />
                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                    </div>
                </div>

                <!-- Telefoon & Werknemers Aantal (2 fields side-by-side) -->
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="phone" :value="__('Telefoon')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                            :value="old('phone')" placeholder="Placeholder" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="employee_count" :value="__('Werknemers aantal')" />
                        <x-text-input id="employee_count" class="block mt-1 w-full" type="number"
                            name="employee_count" :value="old('employee_count')" placeholder="Placeholder" />
                        <x-input-error :messages="$errors->get('employee_count')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit & Already Registered Link -->
        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

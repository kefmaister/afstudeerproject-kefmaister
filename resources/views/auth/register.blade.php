<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data"
        class="max-w-4xl mx-auto space-y-4 mt-10">
        @csrf

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <x-input-label for="firstname" :value="__('Voornaam')" />
                <x-text-input id="firstname" name="firstname" type="text" :value="old('firstname')" required autofocus
                    placeholder="Placeholder" class="w-full mt-1" />
                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="lastname" :value="__('Achternaam')" />
                <x-text-input id="lastname" name="lastname" type="text" :value="old('lastname')" required autofocus
                    placeholder="Placeholder" class="w-full mt-1" />
                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
            </div>
        </div>
        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" name="email" type="email" :value="old('email')" required autofocus
                placeholder="Placeholder" class="w-full mt-1" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="password" :value="__('Wachtwoord')" />
                <x-text-input id="password" name="password" type="password" required placeholder="Placeholder"
                    class="w-full mt-1" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="password_confirmation" :value="__('Bevestig wachtwoord')" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" required
                    placeholder="Placeholder" class="w-full mt-1" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <!-- Logo + Company Name -->
        <div class="flex flex-col md:flex-row gap-4 items-start">
            <!-- Logo Upload -->
            <div class="w-full md:w-1/2">
                <x-input-label for="logo" :value="__('Logo')" />
                <label for="logo"
                    class="aspect-square border-2 border-gray-400 rounded flex items-center justify-center bg-gray-100 mt-1 cursor-pointer">
                    <div id="logo-container">
                        @if (session('temp_logo'))
                            <img src="{{ session('temp_logo') }}" alt="Logo Preview" class="h-full w-full object-cover">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 16l4-4a3 3 0 014.24 0L15 16M3 16v2a1 1 0 001 1h16a1 1 0 001-1v-2M3 16l6-6a3 3 0 014.24 0L21 16" />
                            </svg>
                        @endif
                    </div>
                </label>
                <input id="logo" name="logo" type="file" accept="image/*" class="hidden"
                    onchange="previewLogo(event)">
                <div id="logo-preview" class="mt-2"></div>
            </div>

            <!-- Company Info -->
            <div class="w-full md:w-1/2 space-y-4">
                <!-- Company Name -->
                <div>
                    <x-input-label for="company_name" :value="__('Bedrijf naam')" />
                    <x-text-input id="company_name" name="company_name" type="text" placeholder="Placeholder"
                        :value="old('company_name')" class="w-full mt-1" />
                    <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                </div>

                <!-- VAT Number -->
                <div>
                    <x-input-label for="company_vat" :value="__('BTW nummer')" />
                    <x-text-input id="company_vat" name="company_vat" type="text" placeholder="Placeholder"
                        :value="old('company_vat')" class="w-full mt-1" />
                    <x-input-error :messages="$errors->get('company_vat')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="employee_count" :value="__('Werknemers aantal')" />
                    <x-text-input id="employee_count" name="employee_count" type="number" placeholder="Placeholder"
                        :value="old('employee_count')" class="w-full mt-1" min="0" />
                </div>
            </div>
        </div>

        <script>
            function previewLogo(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const logoContainer = document.getElementById('logo-container');
                        logoContainer.innerHTML =
                            `<img src="${e.target.result}" alt="Logo Preview" class="h-full w-full object-cover">`;
                    };
                    reader.readAsDataURL(file);
                }
            }
        </script>

        <!-- Address Row 1: Straat, Nr, Bus -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <x-input-label for="street" :value="__('Straat')" />
                <x-text-input id="street" name="street" type="text" placeholder="Placeholder" :value="old('street')"
                    class="w-full mt-1" />
            </div>
            <div>
                <x-input-label for="nr" :value="__('Nr.')" />
                <x-text-input id="nr" name="nr" type="text" placeholder="Placeholder" :value="old('nr')"
                    class="w-full mt-1" />
            </div>
            <div>
                <x-input-label for="bus" :value="__('Bus')" />
                <x-text-input id="bus" name="bus" type="text" placeholder="Placeholder" :value="old('bus')"
                    class="w-full mt-1" />
            </div>
        </div>

        <!-- Address Row 2: Gemeente, Postcode -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="town" :value="__('Gemeente')" />
                <x-text-input id="town" name="town" type="text" placeholder="Placeholder"
                    :value="old('town')" class="w-full mt-1" />
            </div>
            <div>
                <x-input-label for="zip" :value="__('Postcode')" />
                <x-text-input id="zip" name="zip" type="text" placeholder="Placeholder"
                    :value="old('zip')" class="w-full mt-1" />
            </div>
        </div>

        <!-- Address Row 3: Land, Telefoon -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
            <x-input-label for="country" :value="__('Land')" />
            <select id="country" name="country"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="België" selected>België</option>
                <option value="Nederland">Nederland</option>
                <option value="Frankrijk">Frankrijk</option>
            </select>
            <x-input-error :messages="$errors->get('country')" />
            </div>

            <div class="flex justify-end items-end">
            <x-primary-button class="w-full md:w-auto">
                {{ __('Register') }}
            </x-primary-button>
            </div>
        </div>

    </form>
</x-guest-layout>

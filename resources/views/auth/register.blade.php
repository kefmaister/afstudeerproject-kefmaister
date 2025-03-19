<x-guest-layout wide="true">
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
                <x-text-input id="firstname" name="firstname" type="text" :value="old('firstname')" required
                    placeholder="Enter your first name" class="w-full mt-1" />
                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="lastname" :value="__('Achternaam')" />
                <x-text-input id="lastname" name="lastname" type="text" :value="old('lastname')" required
                    placeholder="Enter your last name" class="w-full mt-1" />
                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
            </div>
        </div>
        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" name="email" type="email" :value="old('email')" required
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Enter your email" class="w-full mt-1" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="password" :value="__('Wachtwoord')" />
                <x-text-input id="password" name="password" type="password" required placeholder="Enter your password"
                    class="w-full mt-1" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="password_confirmation" :value="__('Bevestig wachtwoord')" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" required
                    placeholder="Confirm your password" class="w-full mt-1" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <!-- Logo + Company Name -->
        <div class="flex flex-col md:flex-row gap-4 items-start">
            <!-- Logo Upload -->
            <div class="w-full md:w-1/3">
                <x-input-label for="logo" :value="__('Logo')" />

                <label for="logo"
                    class="aspect-square border-2 border-gray-400 rounded flex items-center justify-center bg-gray-100 mt-1 cursor-pointer
                    {{ $errors->has('logo') ? 'border-red-500' : '' }}">
                    <div id="logo-container">
                        @if (session('temp_logo'))
                            <img src="{{ session('temp_logo') }}" alt="Logo Preview" class="h-full w-full object-cover">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M16 12l-4-4m0 0l-4 4m4-4v12" />
                            </svg>
                        @endif
                    </div>
                </label>

                <input id="logo" name="logo" type="file" accept="image/*" class="hidden"
                    onchange="previewLogo(event)" required>
            </div>



            <!-- Company Info -->
            <div class="w-full md:w-1/2 space-y-4">
                <!-- Company Name -->
                <div>
                    <x-input-label for="company_name" :value="__('Bedrijf naam')" />
                    <x-text-input id="company_name" name="company_name" type="text" placeholder="Your company name"
                        :value="old('company_name')" class="w-full mt-1" />
                    <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                </div>

                <!-- VAT Number -->
                <div>
                    <x-input-label for="company_vat" :value="__('BTW nummer')" />
                    <x-text-input id="company_vat" name="company_vat" type="text" placeholder="Company VAT number"
                        :value="old('company_vat')" class="w-full mt-1" />
                    <x-input-error :messages="$errors->get('company_vat')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="employee_count" :value="__('Werknemers aantal')" />
                    <x-text-input id="employee_count" name="employee_count" type="number" placeholder="Workers amount"
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

        <div>
            <x-input-label for="website" :value="__('Website')" />
            <x-text-input id="website" name="website" type="url" :value="old('website')" required autofocus
                pattern="https?://.+" placeholder="https://example.com" class="w-full mt-1" />
            <x-input-error :messages="$errors->get('website')" class="mt-2" />
        </div>

        <!-- Address Row 1: Straat, Nr, Bus -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <x-input-label for="street" :value="__('Straat')" />
                <x-text-input id="street" name="street" type="text" placeholder="Street name"
                    :value="old('street')" class="w-full mt-1" />
            </div>
            <div>
                <x-input-label for="nr" :value="__('Nr.')" />
                <x-text-input id="nr" name="nr" type="text" placeholder="street number"
                    :value="old('nr')" class="w-full mt-1" />
            </div>
        </div>

        <!-- Address Row 2: Gemeente, Postcode -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="town" :value="__('Gemeente')" />
                <x-text-input id="town" name="town" type="text" placeholder="City" :value="old('town')"
                    class="w-full mt-1" />
            </div>
            <div>
                <x-input-label for="zip" :value="__('Postcode')" />
                <x-text-input id="zip" name="zip" type="text" placeholder="Zip code" :value="old('zip')"
                    class="w-full mt-1" />
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
                    <option value="Duitsland">Duitsland</option>
                    <option value="Luxemburg">Luxemburg</option>
                    <option value="Oostenrijk">Oostenrijk</option>
                    <option value="Bulgarije">Bulgarije</option>
                    <option value="Kroatië">Kroatië</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Tsjechië">Tsjechië</option>
                    <option value="Denemarken">Denemarken</option>
                    <option value="Estland">Estland</option>
                    <option value="Finland">Finland</option>
                    <option value="Griekenland">Griekenland</option>
                    <option value="Hongarije">Hongarije</option>
                    <option value="Ierland">Ierland</option>
                    <option value="Italië">Italië</option>
                    <option value="Letland">Letland</option>
                    <option value="Litouwen">Litouwen</option>
                    <option value="Malta">Malta</option>
                    <option value="Polen">Polen</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Roemenië">Roemenië</option>
                    <option value="Slovenië">Slovenië</option>
                    <option value="Slowakije">Slowakije</option>
                    <option value="Spanje">Spanje</option>
                    <option value="Zweden">Zweden</option>
                </select>
                <x-input-error :messages="$errors->get('country')" />
            </div>

            <div class="flex justify-end items-end">
                <x-primary-button class="w-full md:w-auto">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-6">
                <strong class="block font-semibold mb-2">Er zijn enkele fouten bij het invullen van het
                    formulier:</strong>
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </form>
</x-guest-layout>

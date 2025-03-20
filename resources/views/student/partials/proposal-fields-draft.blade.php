<!-- In resources/views/student/partials/proposal-fields-draft.blade.php -->

<!-- Draft: Student can fill out the form -->
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <form method="POST" action="{{ route('proposal.store') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="stage_id" value="{{ $proposal->stage_id ?? '' }}">

        <!-- Row 1: Company Name, Street, Nr -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Bedrijf Naam -->
            <div>
                <label for="company_name" class="block font-semibold mb-1">Bedrijfsnaam</label>
                <input type="text" name="company_name" id="company_name" placeholder="Vul de bedrijfsnaam in"
                    value="{{ old('company_name', $proposal->stage->company->company_name ?? '') }}"
                    class="w-full border-gray-300 rounded p-2" />
                @error('company_name')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div>

            </div>
            <div>

            </div>
        </div>

        <!-- Row 2: Straat, Nr, Postcode, Gemeente -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Straat -->
            <div>
                <label for="street" class="block font-semibold mb-1">Straat</label>
                <input type="text" name="street" id="street" placeholder="Vul de straatnaam in"
                    value="{{ old('street', $proposal->stage->company->street ?? '') }}"
                    class="w-full border-gray-300 rounded p-2" />
                @error('street')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nr -->
            <div>
                <label for="nr" class="block font-semibold mb-1">Nr</label>
                <input type="text" name="nr" id="nr" placeholder="Vul het huisnummer in"
                    value="{{ old('nr', $proposal->stage->company->streetNr ?? '') }}"
                    class="w-full border-gray-300 rounded p-2" />
                @error('nr')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- Postcode -->
            <div>
                <label for="zip" class="block font-semibold mb-1">Postcode</label>
                <input type="text" name="zip" id="zip" placeholder="Vul de postcode in"
                    value="{{ old('zip', $proposal->stage->company->zip ?? '') }}"
                    class="w-full border-gray-300 rounded p-2" />
                @error('zip')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- Gemeente -->
            <div>
                <label for="town" class="block font-semibold mb-1">Gemeente</label>
                <input type="text" name="town" id="town" placeholder="Vul de gemeente in"
                    value="{{ old('town', $proposal->stage->company->town ?? '') }}"
                    class="w-full border-gray-300 rounded p-2" />
                @error('town')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        @php
            $mentor = $proposal->stage->mentor ?? null;
        @endphp


        <!-- Row 3: mentor naam, E-mail stagementor -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Voornaam -->
            <div>
                <label for="stage_mentor_firstname" class="block font-semibold mb-1">Voornaam stagementor</label>
                <input type="text" name="stage_mentor_firstname" id="stage_mentor_firstname" placeholder="Vul de voornaam in"
                    value="{{ old('stage_mentor_firstname', $mentor->firstname ?? '') }}"
                    class="w-full border-gray-300 rounded p-2" />
                @error('stage_mentor_firstname')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- Achternaam -->
            <div>
                <label for="stage_mentor_lastname" class="block font-semibold mb-1">Achternaam stagementor</label>
                <input type="text" name="stage_mentor_lastname" id="stage_mentor_lastname" placeholder="Vul de achternaam in"
                    value="{{ old('stage_mentor_lastname', $mentor->lastname ?? '') }}"
                    class="w-full border-gray-300 rounded p-2" />
                @error('stage_mentor_lastname')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- E-mail -->
            <div>
                <label for="stage_mentor_email" class="block font-semibold mb-1">E-mail stagementor</label>
                <input type="email" name="stage_mentor_email" id="stage_mentor_email" placeholder="Vul het e-mailadres in"
                    value="{{ old('stage_mentor_email', $mentor->email ?? '') }}"
                    class="w-full border-gray-300 rounded p-2" />
                @error('stage_mentor_email')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- Telefoonnummer -->
            <div>
                <label for="stage_mentor_phone" class="block font-semibold mb-1">Telefoonnummer stagementor</label>
                <input type="text" name="stage_mentor_phone" id="stage_mentor_phone" placeholder="Vul het telefoonnummer in"
                    value="{{ old('stage_mentor_phone', $mentor->phone ?? '') }}"
                    class="w-full border-gray-300 rounded p-2" />
                @error('stage_mentor_phone')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <!-- Row 4: Taken toelichting -->
        <div>
            <label for="tasks" class="block font-semibold mb-1">Taken toelichting</label>
            <textarea name="tasks" id="tasks" placeholder="Beschrijf de taken" class="w-full border-gray-300 rounded p-2">{{ old('tasks', $proposal->stage->tasks ?? '') }}</textarea>
            @error('tasks')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <!-- Row 5: Persoonlijke motivatie -->
        <div>
            <label for="motivation" class="block font-semibold mb-1">Persoonlijke motivatie</label>
            <textarea name="motivation" id="motivation" placeholder="Beschrijf je persoonlijke motivatie" class="w-full border-gray-300 rounded p-2">{{ old('motivation', $proposal->motivation ?? '') }}</textarea>
            @error('motivation')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit button -->
        <div class="mt-4">
            <x-primary-button>
                Versturen
            </x-primary-button>
        </div>
    </form>
</div>

<!-- In resources/views/student/partials/proposal-fields-draft.blade.php -->

<!-- Draft: Student can fill out the form -->
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <form method="POST" action="{{ route('proposal.store') }}" class="space-y-4">
        @csrf

        <!-- Row 1: Company Name, Street, Nr -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Bedrijf Naam -->
            <div>
                <label for="company_name" class="block font-semibold mb-1">Bedrijf Naam</label>
                <input type="text" name="company_name" id="company_name" placeholder="Placeholder"
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
                <input type="text" name="street" id="street" placeholder="Placeholder"
                    value="{{ old('street', $proposal->stage->company->street ?? '') }}"
                    class="w-full border-gray-300 rounded p-2" />
                @error('street')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nr -->
            <div>
                <label for="nr" class="block font-semibold mb-1">Nr</label>
                <input type="text" name="nr" id="nr" placeholder="Placeholder"
                    value="{{ old('nr', $proposal->stage->company->streetNr ?? '') }}"
                    class="w-full border-gray-300 rounded p-2" />
                @error('nr')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- Postcode -->
            <div>
                <label for="zip" class="block font-semibold mb-1">Postcode</label>
                <input type="text" name="zip" id="zip" placeholder="Placeholder"
                    value="{{ old('zip', $proposal->stage->company->zip ?? '') }}"
                    class="w-full border-gray-300 rounded p-2" />
                @error('zip')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- Gemeente -->
            <div>
                <label for="town" class="block font-semibold mb-1">Gemeente</label>
                <input type="text" name="town" id="town" placeholder="Placeholder"
                    value="{{ old('town', $proposal->stage->company->town ?? '') }}"
                    class="w-full border-gray-300 rounded p-2" />
                @error('town')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Row 3: mentor naam, E-mail stagementor -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- mentor naam -->
            <div>
                <label for="stage_mentor" class="block font-semibold mb-1">Naam stagementor</label>
                <input type="text" name="stage_mentor" id="stage_mentor" placeholder="Placeholder"
                    value="{{ old('stage_mentor', $proposal->stage_mentor ?? '') }}"
                    class="w-full border-gray-300 rounded p-2" />
                @error('stage_mentor')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- E-mail stagementor -->
            <div>
                <label for="stage_mentor_email" class="block font-semibold mb-1">E-mail stagementor</label>
                <input type="email" name="stage_mentor_email" id="stage_mentor_email" placeholder="Placeholder"
                    value="{{ old('stage_mentor_email', $proposal->stage_mentor_email ?? '') }}"
                    class="w-full border-gray-300 rounded p-2" />
                @error('stage_mentor_email')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Row 4: Taken toelichting -->
        <div>
            <label for="tasks" class="block font-semibold mb-1">Taken toelichting</label>
            <textarea name="tasks" id="tasks" placeholder="Placeholder" class="w-full border-gray-300 rounded p-2">{{ old('tasks', $proposal->tasks ?? '') }}</textarea>
            @error('tasks')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <!-- Row 5: Persoonlijke motivatie -->
        <div>
            <label for="motivation" class="block font-semibold mb-1">Persoonlijke motivatie</label>
            <textarea name="motivation" id="motivation" placeholder="Placeholder" class="w-full border-gray-300 rounded p-2">{{ old('motivation', $proposal->motivation ?? '') }}</textarea>
            @error('motivation')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit button -->
        <div class="mt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Versturen
            </button>
        </div>
    </form>
</div>

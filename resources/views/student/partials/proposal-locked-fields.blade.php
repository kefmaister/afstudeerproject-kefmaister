<div class="grid grid-cols-2 gap-4">
    <!-- Company Name -->
    <div>
        <label class="block font-semibold mb-1">Bedrijf naam</label>
        <input type="text" value="{{ $proposal->stage->company->company_name ?? '' }}" disabled
            class="w-full border-gray-300 rounded p-2 bg-gray-100">
    </div>
    <div>
        <label class="block font-semibold mb-1">Straat</label>
        <input type="text" value="{{ $proposal->stage->company->street ?? '' }}" disabled
            class="w-full border-gray-300 rounded p-2 bg-gray-100">
    </div>

    <!-- Nr / Postcode -->
    <div>
        <label class="block font-semibold mb-1">Nr</label>
        <input type="text" value="{{ $proposal->stage->company->streetNr ?? '' }}" disabled
            class="w-full border-gray-300 rounded p-2 bg-gray-100">
    </div>
    <div>
        <label class="block font-semibold mb-1">Postcode</label>
        <input type="text" value="{{ $proposal->stage->company->zip ?? '' }}" disabled
            class="w-full border-gray-300 rounded p-2 bg-gray-100">
    </div>

    <!-- Gemeente / Mentor -->
    <div>
        <label class="block font-semibold mb-1">Gemeente</label>
        <input type="text" value="{{ $proposal->stage->company->town ?? '' }}" disabled
            class="w-full border-gray-300 rounded p-2 bg-gray-100">
    </div>
    <div>
        <label class="block font-semibold mb-1">Naam stagementor</label>
        <input type="text"
            value="{{ $proposal->stage->company->mentor->firstname ?? '' }} {{ $proposal->stage->company->mentor->lastname ?? '' }}"
            disabled class="w-full border-gray-300 rounded p-2 bg-gray-100">
    </div>

    <!-- Mentor Email -->
    <div>
        <label class="block font-semibold mb-1">E-mail stagementor</label>
        <input type="text" value="{{ $proposal->stage->company->mentor->email ?? '' }}" disabled
            class="w-full border-gray-300 rounded p-2 bg-gray-100">
    </div>

    <!-- Mentor phone -->
    <div>
        <label class="block font-semibold mb-1">Telefoon stagementor</label>
        <input type="text" value="{{ $proposal->stage->company->mentor->phone ?? '' }}" disabled
            class="w-full border-gray-300 rounded p-2 bg-gray-100">
    </div>

    <!-- Tasks -->
    <div class="col-span-2">
        <label class="block font-semibold mb-1">Taken toelichting</label>
        <textarea disabled class="w-full border-gray-300 rounded p-2 bg-gray-100" rows="3">{{ $proposal->tasks ?? '' }}</textarea>
    </div>

    <!-- Motivation -->
    <div class="col-span-2">
        <label class="block font-semibold mb-1">Persoonlijke motivatie</label>
        <textarea disabled class="w-full border-gray-300 rounded p-2 bg-gray-100" rows="3">{{ $proposal->motivation ?? '' }}</textarea>
    </div>
</div>

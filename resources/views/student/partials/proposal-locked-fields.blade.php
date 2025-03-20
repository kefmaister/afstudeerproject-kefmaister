@php
    $mentor = $proposal->stage->mentor ?? null;
@endphp

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold mb-1">Bedrijfsnaam</label>
            <input type="text" value="{{ $proposal->stage->company->company_name ?? '' }}" disabled
                class="w-full border-gray-300 rounded p-2 bg-gray-100">
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block font-semibold mb-1">Straat</label>
            <input type="text" value="{{ $proposal->stage->company->street ?? '' }}" disabled
                class="w-full border-gray-300 rounded p-2 bg-gray-100">
        </div>
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
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold mb-1">Gemeente</label>
            <input type="text" value="{{ $proposal->stage->company->town ?? '' }}" disabled
                class="w-full border-gray-300 rounded p-2 bg-gray-100">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold mb-1">Voornaam stagementor</label>
            <input type="text" value="{{ $mentor->firstname ?? '' }}" disabled
                class="w-full border-gray-300 rounded p-2 bg-gray-100">
        </div>
        <div>
            <label class="block font-semibold mb-1">Achternaam stagementor</label>
            <input type="text" value="{{ $mentor->lastname ?? '' }}" disabled
                class="w-full border-gray-300 rounded p-2 bg-gray-100">
        </div>
        <div>
            <label class="block font-semibold mb-1">E-mail stagementor</label>
            <input type="text" value="{{ $mentor->email ?? '' }}" disabled
                class="w-full border-gray-300 rounded p-2 bg-gray-100">
        </div>
        <div>
            <label class="block font-semibold mb-1">Telefoonnummer stagementor</label>
            <input type="text" value="{{ $mentor->phone ?? '' }}" disabled
                class="w-full border-gray-300 rounded p-2 bg-gray-100">
        </div>
    </div>

    <div>
        <label class="block font-semibold mb-1">Taken toelichting</label>
        <textarea disabled class="w-full border-gray-300 rounded p-2 bg-gray-100" rows="3">
{{ $proposal->tasks ?? '' }}</textarea>
    </div>

    <div>
        <label class="block font-semibold mb-1">Persoonlijke motivatie</label>
        <textarea disabled class="w-full border-gray-300 rounded p-2 bg-gray-100" rows="3">
{{ $proposal->motivation ?? '' }}</textarea>
    </div>
</div>

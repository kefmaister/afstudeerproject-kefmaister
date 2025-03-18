<x-app>
    <x-slot name="header">
        <h1 class="text-xl font-bold">Bedrijfsprofiel Bewerken</h1>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow relative">
        {{-- Logo Top Right --}}
        <div class="absolute top-4 right-4">
            @if ($company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" alt="Bedrijfslogo"
                    class="h-24 w-24 object-cover rounded border" />
            @else
                <div class="h-24 w-24 bg-gray-100 border flex items-center justify-center text-sm text-gray-500 rounded">
                    Geen logo
                </div>
            @endif
        </div>

        <form method="POST" action="{{ route('company.profile.update') }}" enctype="multipart/form-data"
            class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mt-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold mb-1" for="company_name">Bedrijfsnaam</label>
                <input type="text" name="company_name" id="company_name"
                    value="{{ old('company_name', $company->company_name) }}" class="w-full border-gray-300 rounded p-2"
                    required>
            </div>

            <div>
                <label class="block font-semibold mb-1" for="company_vat">BTW-nummer</label>
                <input type="text" name="company_vat" id="company_vat"
                    value="{{ old('company_vat', $company->company_vat) }}" class="w-full border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1" for="street">Straat</label>
                <input type="text" name="street" id="street" value="{{ old('street', $company->street) }}"
                    class="w-full border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1" for="streetNr">Nummer</label>
                <input type="text" name="streetNr" id="streetNr" value="{{ old('streetNr', $company->streetNr) }}"
                    class="w-full border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1" for="zip">Postcode</label>
                <input type="text" name="zip" id="zip" value="{{ old('zip', $company->zip) }}"
                    class="w-full border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1" for="town">Gemeente</label>
                <input type="text" name="town" id="town" value="{{ old('town', $company->town) }}"
                    class="w-full border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1" for="country">Land</label>
                <input type="text" name="country" id="country" value="{{ old('country', $company->country) }}"
                    class="w-full border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1" for="website">Website</label>
                <input type="url" name="website" id="website" value="{{ old('website', $company->website) }}"
                    class="w-full border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1" for="phone">Telefoonnummer</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $company->phone) }}"
                    class="w-full border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1" for="employee_count">Aantal Werknemers</label>
                <input type="number" name="employee_count" id="employee_count"
                    value="{{ old('employee_count', $company->employee_count) }}"
                    class="w-full border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1" for="max_students">Max. aantal studenten</label>
                <input type="number" name="max_students" id="max_students"
                    value="{{ old('max_students', $company->max_students) }}"
                    class="w-full border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1" for="student_amount">Huidige studenten</label>
                <input type="number" name="student_amount" id="student_amount"
                    value="{{ old('student_amount', $company->student_amount) }}"
                    class="w-full border-gray-300 rounded p-2">
            </div>

            <div class="col-span-2">
                <label class="block font-semibold mb-1" for="logo">Logo bijwerken</label>
                <input type="file" name="logo" id="logo" class="w-full border-gray-300 rounded p-2">
            </div>

            <div class="col-span-2 text-right mt-4">
                <x-primary-button>Opslaan</x-primary-button>
            </div>
        </form>
    </div>
</x-app>

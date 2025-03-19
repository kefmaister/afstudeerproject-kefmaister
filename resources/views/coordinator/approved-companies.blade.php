<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Goedgekeurde Bedrijven & Studenten</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-6 space-y-6">
        <div class="max-w-6xl mx-auto mt-6">
            <label for="scrollSearch" class="block font-semibold mb-2">Zoek student of bedrijf</label>
            <input type="text" id="scrollSearch" placeholder="Typ naam van student of bedrijf"
                class="border border-gray-300 rounded px-4 py-2 w-full md:w-1/3 mb-4" onkeyup="scrollToMatch()">
        </div>

        @forelse ($companies as $company)
            <div id="company-{{ $company->id }}" class="bg-white shadow rounded p-6">
                <h3 class="text-xl font-bold mb-2">{{ $company->company_name }}</h3>
                <p class="text-gray-600 mb-4">{{ $company->street }} {{ $company->streetNr }}, {{ $company->zip }}
                    {{ $company->town }}</p>

                <h4 class="font-semibold mb-2">Studenten met goedgekeurde voorstellen:</h4>

                @php
                    $students = collect();
                    foreach ($company->stages as $stage) {
                        foreach ($stage->proposals as $proposal) {
                            if ($proposal->status === 'approved') {
                                $students->push($proposal->student);
                            }
                        }
                    }
                @endphp

                @if ($students->isEmpty())
                    <p class="text-gray-500 italic">Geen goedgekeurde studenten.</p>
                @else
                    <ul class="list-disc pl-5">
                        @foreach ($students->unique('id') as $student)
                            <li id="student-{{ $student->id }}">{{ $student->user->firstname }}
                                {{ $student->user->lastname }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

        @empty
            <p class="text-gray-600">Geen goedgekeurde bedrijven gevonden.</p>
        @endforelse
    </div>
    <script>
        function scrollToMatch() {
            const input = document.getElementById('scrollSearch');
            const query = input.value.toLowerCase().trim();
            if (!query) return;

            const studentEls = document.querySelectorAll('[id^="student-"]');
            const companyEls = document.querySelectorAll('[id^="company-"]');

            // Search in students
            for (const el of studentEls) {
                if (el.textContent.toLowerCase().includes(query)) {
                    el.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    el.classList.add('bg-yellow-100');
                    setTimeout(() => el.classList.remove('bg-yellow-100'), 2000);
                    return;
                }
            }

            // Fallback: Search in company names
            for (const el of companyEls) {
                const name = el.querySelector('h3')?.textContent?.toLowerCase() ?? '';
                if (name.includes(query)) {
                    el.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    el.classList.add('bg-yellow-100');
                    setTimeout(() => el.classList.remove('bg-yellow-100'), 2000);
                    return;
                }
            }
        }
    </script>

</x-app-layout>

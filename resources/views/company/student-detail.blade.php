<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Student Detail</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white p-6 rounded shadow">
        <!-- 🔙 Go Back Button -->
        <div class="mb-4">
            <a href="{{ route('company.student-list') }}"
                class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded transition">
                ← Terug naar studentenlijst
            </a>
        </div>

        <h1 class="text-2xl font-bold mb-6">
            {{ $student->user->firstname }} {{ $student->user->lastname }}
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- CV Preview -->
            <div>
                <h2 class="text-lg font-semibold mb-2">CV Voorbeeld</h2>
                @if ($cv && $cv->file)
                    <iframe src="{{ asset('storage/' . $cv->file) }}" style="width: 100%; height: 500px;"
                        frameborder="0">
                    </iframe>
                @else
                    <p class="text-gray-600">Geen CV geüpload.</p>
                @endif
            </div>

            <!-- Download button -->
            <div>
                <h2 class="text-lg font-semibold mb-2">Acties</h2>
                @if ($cv && $cv->file)
                    <a href="{{ asset('storage/' . $cv->file) }}" download
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        ⬇️ Download CV
                    </a>
                @else
                    <p class="text-gray-600">Geen download beschikbaar.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

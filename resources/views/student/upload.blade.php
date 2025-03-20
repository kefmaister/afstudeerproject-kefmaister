<x-app>
    <x-slot name="header">
        <h1>Upload CV</h1>
    </x-slot>

    <!-- Status Bericht -->
    @if (session('status'))
        <div class="mb-4 text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Linker Kolom: PDF Voorbeeld -->
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Voorbeeld</h2>

            @if (isset($cv) && $cv->exists)
                <!-- Opmerking: verwijzing naar $cv->file hier -->
                <iframe src="{{ asset('storage/' . $cv->file) }}" style="width: 100%; height: 600px;"
                    frameborder="0"></iframe>
            @else
                <p class="text-gray-600">Nog geen CV geüpload.</p>
            @endif
        </div>

        <!-- Rechter Kolom: Upload Instructies -->
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Upload CV (alleen PDF)</h2>
            <p class="mb-2">1) PDF formaat</p>
            <p class="mb-2">2) Max 2MB</p>
            <p class="mb-2">3) Geen zwart-wit</p>
            <p class="mb-4">4) Alle info vind je terug op Canvas</p>

            <!-- Upload Formulier -->
            <form action="{{ route('student.storeUpload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" accept="application/pdf" class="block mb-2" required>
                @error('file')
                    <div class="text-red-600 mb-2">{{ $message }}</div>
                @enderror

                <x-primary-button>
                    Upload CV
                </x-primary-button>
            </form>

            <!-- Status & Feedback Weergeven -->
            @if (isset($cv) && $cv->exists)
                <div class="mt-4">
                    <h3 class="font-semibold">Status</h3>
                    <p class="text-yellow-600">In behandeling</p>

                    <h3 class="font-semibold mt-4">Feedback</h3>
                    <p>{{ $cv->feedback }}</p>
                </div>
            @endif
        </div>
    </div>
</x-app>

<x-app>
    <x-slot name="header">
        <h1 class="text-xl font-bold">Student Profiel</h1>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        @if (session('status'))
            <div class="mb-4 text-green-600 font-semibold">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('student.profile.update') }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Firstname -->
                <div>
                    <label class="block font-semibold" for="firstname">Voornaam</label>
                    <input type="text" name="firstname" value="{{ old('firstname', auth()->user()->firstname) }}"
                        class="w-full border rounded p-2" required />
                    @error('firstname')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Lastname -->
                <div>
                    <label class="block font-semibold" for="lastname">Achternaam</label>
                    <input type="text" name="lastname" value="{{ old('lastname', auth()->user()->lastname) }}"
                        class="w-full border rounded p-2" required />
                    @error('lastname')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="md:col-span-2">
                    <label class="block font-semibold" for="email">E-mail</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                        class="w-full border rounded p-2" required />
                    @error('email')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="md:col-span-2">
                    <label class="block font-semibold" for="password">Nieuw wachtwoord (optioneel)</label>
                    <input type="password" name="password" class="w-full border rounded p-2" />
                    @error('password')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Read-only Fields -->
            <div class="mt-6 border-t pt-4 text-sm text-gray-600 space-y-2">
                <p><strong>Klas:</strong> {{ $student->class }}</p>
                <p><strong>Studierichting:</strong> {{ $student->studyfield->name }}</p>
                <p><strong>Jaar:</strong> {{ $student->year }}</p>
            </div>

            <div class="mt-6">
                <x-primary-button>Profiel bijwerken</x-primary-button>
            </div>
        </form>
    </div>
</x-app>

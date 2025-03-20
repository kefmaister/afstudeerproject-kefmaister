<x-app>
    <x-slot name="header">
        <h1 class="text-xl font-bold">Profiel</h1>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <form method="POST" action="{{ route('coordinator.profile.update') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold" for="firstname">Voornaam</label>
                <input type="text" name="firstname" id="firstname"
                    value="{{ old('firstname', $coordinator->user->firstname) }}" class="w-full border rounded p-2"
                    required>
                @error('firstname')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-semibold" for="lastname">Achternaam</label>
                <input type="text" name="lastname" id="lastname"
                    value="{{ old('lastname', $coordinator->user->lastname) }}" class="w-full border rounded p-2"
                    required>
                @error('lastname')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-semibold" for="email">E-mailadres</label>
                <input type="email" name="email" id="email"
                    value="{{ old('email', $coordinator->user->email) }}" class="w-full border rounded p-2" required>
                @error('email')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <x-primary-button>Opslaan</x-primary-button>
        </form>
    </div>
</x-app>

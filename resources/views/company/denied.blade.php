<x-app>
    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded shadow text-center">
        <h2 class="text-2xl font-bold text-red-600 mb-4">Je bedrijf werd geweigerd</h2>

        <p class="text-gray-700 text-lg">Reden voor weigering:</p>
        <p class="mt-3 text-gray-800 font-medium italic bg-red-50 px-4 py-2 rounded">
            "{{ $reason }}"
        </p>

        <div class="mt-6 text-gray-700">
            <p class="mb-4">
                Als je denkt dat dit onterecht was of als je jouw gegevens wilt aanpassen,
                kan je contact opnemen met een coördinator of je bedrijfsprofiel bijwerken.
            </p>

            <a href="{{ route('company.profile') }}"
                class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition mb-6">
                🛠️ Bedrijfsgegevens aanpassen
            </a>
        </div>

        <hr class="my-6">

        <div class="text-left">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Contactgegevens coördinatoren</h3>
            <ul class="space-y-2 text-sm">
                @foreach ($coordinators as $coordinator)
                    <li class="flex items-start">
                        <div>
                            <p class="font-medium text-gray-900">
                                {{ $coordinator->user->firstname }} {{ $coordinator->user->lastname }}
                            </p>
                            <p class="text-gray-600">📧 {{ $coordinator->user->email }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app>

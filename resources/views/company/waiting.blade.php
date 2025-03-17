<x-app>
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow text-center">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Bedrijf in beoordeling</h2>
        <p class="text-gray-600">Je aanvraag is in behandeling. Zodra je goedgekeurd bent, krijg je toegang tot het
            dashboard.</p>
        <p class="text-gray-600 mb-6">Bij problemen neem contact op met een van de coördinatoren:</p>

        <div class="space-y-4 text-left">
            @forelse ($coordinators as $coordinator)
                <div class="border border-gray-200 rounded p-3 bg-gray-50 shadow-sm">
                    <h3 class="text-md font-bold">{{ $coordinator->user->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $coordinator->user->email }}</p>
                </div>
            @empty
                <p class="text-gray-500">Geen coördinatoren gevonden.</p>
            @endforelse
        </div>
    </div>
</x-app>

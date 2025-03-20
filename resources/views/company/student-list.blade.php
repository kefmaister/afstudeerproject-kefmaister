<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Studentenlijst</h2>
    </x-slot>

    <h1 class="text-2xl font-semibold mb-4">Studenten met een stages in jouw bedrijf</h1>

    <form method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Zoek op student"
            class="border rounded px-4 py-2 w-full md:w-1/3" />
    </form>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr>
                <th class="border-b py-2">Naam</th>
                <th class="border-b py-2">Stage Titel</th>
                <th class="border-b py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($proposals as $proposal)
                <tr class="border-t">
                    <td class="py-2">
                        <a href="{{ route('company.student.show', $proposal->student->id) }}"
                            class="text-blue-600 hover:underline">
                            {{ $proposal->student->user->firstname }} {{ $proposal->student->user->lastname }}
                        </a>
                    </td>

                    <td class="py-2">{{ $proposal->stage->title }}</td>
                    <td class="py-2">
                        @if ($proposal->status == 'approved')
                            ✅ Goedgekeurd
                        @elseif ($proposal->status == 'denied')
                            ❌ Geweigerd
                        @else
                            ⏳ In afwachting
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4">Geen studenten gevonden.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $proposals->links() }}
    </div>

</x-app-layout>

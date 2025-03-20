@props(['students', 'currentStudent'])

<div x-data="{ open: false, search: '' }" class="relative">
    <button @click="open = !open"
        class="bg-gray-100 px-3 py-2 rounded hover:bg-gray-200 focus:outline-none w-48 text-left flex items-center">
        <span class="mr-2 truncate"
            style="max-width: calc(100% - 1.5rem);">{{ $currentStudent->user->firstname . ' ' . $currentStudent->user->lastname }}</span>
        <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>
    <div x-show="open" @click.away="open = false" class="absolute mt-2 w-48 bg-white border rounded shadow">
        <div class="p-2">
            <input type="text" x-model="search" placeholder="Zoeken..." class="border rounded w-full p-1" />
        </div>
        <ul class="divide-y divide-gray-200 max-h-48 overflow-y-auto">
            @foreach ($students as $s)
                @php
                    $icon = '';
                    if ($s->proposal) {
                        switch ($s->proposal->status) {
                            case 'pending':
                                // Klok-icoon voor in afwachting
                                $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-500 inline-block ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3M12 20a8 8 0 100-16 8 8 0 000 16z"/>
                                         </svg>';
                                break;
                            case 'approved':
                                // Vink-icoon voor goedgekeurd
                                $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500 inline-block ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                     </svg>';
                                break;
                            case 'denied':
                                // Kruis-icoon voor afgewezen
                                $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500 inline-block ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                     </svg>';
                                break;
                            // Als het een concept is, geen icoon
                        }
                    }
                @endphp
                <li
                    x-show="search === '' || '{{ strtolower($s->user->firstname . ' ' . $s->user->lastname) }}'.includes(search.toLowerCase())">
                    <a href="{{ route('coordinator.student.proposal', $s->id) }}"
                        class="block px-4 py-2 hover:bg-gray-100">
                        {{ $s->user->firstname . ' ' . $s->user->lastname }} {!! $icon !!}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

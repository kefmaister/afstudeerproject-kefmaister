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
            <input type="text" x-model="search" placeholder="Search..." class="border rounded w-full p-1" />
        </div>
        <ul class="divide-y divide-gray-200 max-h-48 overflow-y-auto">
            @foreach ($students as $s)
                @php
                    $color = 'text-gray-500'; // Default color for N/A
                    if ($s->proposal) {
                        switch ($s->proposal->status) {
                            case 'draft':
                                $color = 'text-blue-500';
                                break;
                            case 'pending':
                                $color = 'text-yellow-500';
                                break;
                            case 'approved':
                                $color = 'text-green-500';
                                break;
                            case 'denied':
                                $color = 'text-red-500';
                                break;
                        }
                    }
                @endphp
                <li
                    x-show="search === '' || '{{ strtolower($s->user->firstname . ' ' . $s->user->lastname) }}'.includes(search.toLowerCase())">
                    <a href="{{ route('coordinator.student.proposal', $s->id) }}"
                        class="block px-4 py-2 hover:bg-gray-100 {{ $color }}">
                        {{ $s->user->firstname . ' ' . $s->user->lastname }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

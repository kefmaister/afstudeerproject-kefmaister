@props([
    'order' => null,
    'search' => null,
    'location' => null,
    'land' => null,
    'locations' => [], // Collectie of array van locatie namen
    'lands' => [], // Collectie of array van land namen
])

<div class="flex flex-wrap items-center gap-4 bg-white p-4 rounded shadow">
    <!-- Sorteer (Alfabetisch of Meest Recent) -->
    <div>
        <label for="order" class="sr-only">Sorteer</label>
        <select id="order" name="order" class="border border-gray-300 rounded p-2 pr-8 min-w-[160px]">
            <option value="alphabet" @selected($order === 'alphabet')>Alfabetisch</option>
            <option value="recent" @selected($order === 'recent')>Meest Recent</option>
        </select>
    </div>

    <!-- Zoek -->
    <div>
        <label for="search" class="sr-only">Zoek</label>
        <input type="text" id="search" name="search" value="{{ $search }}" placeholder="Zoeken..."
            class="border border-gray-300 rounded p-2" />
    </div>

    <!-- Locatie Filter -->
    <div>
        <label for="location" class="sr-only">Locatie</label>
        <select id="location" name="location" class="border border-gray-300 rounded p-2 pr-8 min-w-[160px]">
            <option value="">Alle Locaties</option>
            @foreach ($locations as $loc)
                <option value="{{ $loc }}" @selected($loc == $location)>
                    {{ $loc }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Land Filter -->
    <div>
        <label for="land" class="sr-only">Land</label>
        <select id="land" name="land" class="border border-gray-300 rounded p-2 pr-8 min-w-[150px]">
            <option value="">Alle Landen</option>
            @foreach ($lands as $l)
                <option value="{{ $l }}" @selected($l == $land)>
                    {{ $l }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Filter Knop -->
    <div>
        <x-primary-button>
            Filteren
        </x-primary-button>
    </div>
</div>

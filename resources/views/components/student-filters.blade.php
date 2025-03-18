@props([
    'order' => null,
    'search' => null,
    'location' => null,
    'land' => null,
    'locations' => [], // Collection or array of location names
    'lands' => [], // Collection or array of land names
])

<div class="flex flex-wrap items-center gap-4 bg-white p-4 rounded shadow">
    <!-- Order (Alphabet or Most Recent) -->
    <div>
        <label for="order" class="sr-only">Order</label>
        <select id="order" name="order" class="border border-gray-300 rounded p-2 pr-8 min-w-[160px]">
            <option value="alphabet" @selected($order === 'alphabet')>Alphabet</option>
            <option value="recent" @selected($order === 'recent')>Most Recent</option>
        </select>
    </div>


    <!-- Search -->
    <div>
        <label for="search" class="sr-only">Search</label>
        <input type="text" id="search" name="search" value="{{ $search }}" placeholder="Search..."
            class="border border-gray-300 rounded p-2" />
    </div>

    <!-- Location Filter -->
    <div>
        <label for="location" class="sr-only">Location</label>
        <select id="location" name="location" class="border border-gray-300 rounded p-2 pr-8 min-w-[160px]">
            <option value="">All Locations</option>
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
            <option value="">All Countries</option>
            @foreach ($lands as $l)
                <option value="{{ $l }}" @selected($l == $land)>
                    {{ $l }}
                </option>
            @endforeach
        </select>
    </div>


    <!-- Submit Button -->
    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Filter
        </button>
    </div>
</div>

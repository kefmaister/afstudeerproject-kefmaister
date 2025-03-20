@props([
    'search' => null,
    'studyfield' => null,
    'studyfields' => [],
    'proposalStatus' => null,
    'contractStatus' => null,
])

<div class="flex flex-wrap items-center gap-4 bg-white p-4 rounded shadow">
    <!-- Student Name Search -->
    <div>
        <label for="search" class="sr-only">Zoek student</label>
        <input type="text" id="search" name="search" value="{{ $search }}" placeholder="Zoek op student naam..."
            class="border border-gray-300 rounded p-2" />
    </div>

    <!-- Studyfield Filter -->
    <div>
        <label for="studyfield" class="sr-only">Studierichting</label>
        <select id="studyfield" name="studyfield" class="border border-gray-300 rounded p-2 pr-8 min-w-[200px]">
            <option value="">Alle richtingen</option>
            @foreach ($studyfields as $sf)
                <option value="{{ $sf->id }}" @selected($sf->id == $studyfield)>
                    {{ $sf->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Proposal Status Filter -->
    <div>
        <label for="proposal_status" class="sr-only">Voorstelstatus</label>
        <select id="proposal_status" name="proposal_status"
            class="border border-gray-300 rounded p-2 pr-8 min-w-[200px]">
            <option value="">Alle voorstelstatussen</option>
            <option value="draft" @selected($proposalStatus === 'draft')>Concept</option>
            <option value="pending" @selected($proposalStatus === 'pending')>In afwachting</option>
            <option value="approved" @selected($proposalStatus === 'approved')>Goedgekeurd</option>
            <option value="denied" @selected($proposalStatus === 'denied')>Afgewezen</option>
        </select>
    </div>

    <!-- Submit Button -->
    <div>
        <x-primary-button>
            Filteren
        </x-primary-button>
    </div>
</div>

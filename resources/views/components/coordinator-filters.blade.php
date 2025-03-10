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
        <label for="studyfield" class="sr-only">Studyfield</label>
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
        <label for="proposal_status" class="sr-only">Voorstel Status</label>
        <select id="proposal_status" name="proposal_status"
            class="border border-gray-300 rounded p-2 pr-8 min-w-[200px]">
            <option value="">Alle Voorstelstatussen</option>
            <option value="draft" @selected($proposalStatus === 'draft')>Draft</option>
            <option value="pending" @selected($proposalStatus === 'pending')>Pending</option>
            <option value="approved" @selected($proposalStatus === 'approved')>Approved</option>
            <option value="denied" @selected($proposalStatus === 'denied')>Denied</option>
        </select>
    </div>

    <!-- Submit Button -->
    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Filter
        </button>
    </div>
</div>

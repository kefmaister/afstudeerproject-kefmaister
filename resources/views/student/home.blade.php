<x-app>
    <x-slot name="header">
        <h1>Stageplaatsen</h1>
    </x-slot>

    <!-- Filters Form -->
    <form method="GET" action="{{ route('student.home') }}" class="mb-6">
        <x-student-filters :order="request('order')" :search="request('search')" :location="request('location')" :land="request('land')" :locations="$locations"
            :lands="$lands" />
    </form>

    <!-- 2-Column Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Left Column: Stage List -->
        <div class="col-span-1">
            @include('student.partials.stage-list', ['stages' => $stages])
        </div>

        <!-- Right Column: Selected Stage Details -->
        <div class="col-span-1">
            @include('student.partials.stage-detail', ['selectedStage' => $selectedStage])
        </div>
    </div>
</x-app>

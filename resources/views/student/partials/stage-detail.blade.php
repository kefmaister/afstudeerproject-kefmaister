@if ($selectedStage)
    <div class="bg-white p-4 rounded shadow">
        <div class="flex items-center mb-4">
            @if ($selectedStage->logo && $selectedStage->logo->path)
                <img src="{{ $selectedStage->logo->path }}" alt="Stage Logo" class="h-16 w-16 object-cover mr-4">
            @endif
            <div>
                <h2 class="text-xl font-bold">{{ $selectedStage->title }}</h2>
                @if ($selectedStage->company)
                    <p class="text-sm text-gray-600">{{ $selectedStage->company->company_name }}</p>
                @endif
            </div>
        </div>
        <p class="mb-4">{{ $selectedStage->tasks }}</p>
        @if ($selectedStage->company)
            <p class="text-sm text-gray-700">
                <strong>Location:</strong>
                {{ $selectedStage->company->street ?? '' }}
                {{ $selectedStage->company->streetNr ?? '' }},
                {{ $selectedStage->company->town ?? '' }}
            </p>
        @endif
        <div class="mt-4 flex space-x-2">
            <form method="POST" action="{{ route('proposal.create') }}">
                @csrf
                <input type="hidden" name="stage_id" value="{{ $selectedStage->id }}">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Voorstel</button>
            </form>
            <button class="bg-gray-200 text-black px-4 py-2 rounded">Zicht</button>
        </div>
    </div>
@else
    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-600">Select a stage to see details</p>
    </div>
@endif

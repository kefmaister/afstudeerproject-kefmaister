@if ($selectedStage)
    <div class="bg-white p-4 rounded shadow">
        <div class="flex items-center mb-4">
            @if ($selectedStage->company->logo)
                <img src="{{ asset('storage/' . $selectedStage->company->logo) }}" alt="Stage Logo"
                    class="h-16 w-16 object-cover mr-4 rounded border">
            @endif

            <div>
                <h2 class="text-xl font-bold">{{ $selectedStage->title }}</h2>
                @if ($selectedStage->company)
                    <p class="text-sm text-gray-600">{{ $selectedStage->company->company_name }}</p>
                    <p class="text-sm text-gray-700">
                        <strong>BTW:</strong> {{ $selectedStage->company->company_vat }}
                    </p>
                    @if ($selectedStage->company->website)
                        <p class="text-sm text-blue-600">
                            <a href="{{ $selectedStage->company->website }}" target="_blank" rel="noopener noreferrer">
                                🌐 {{ parse_url($selectedStage->company->website, PHP_URL_HOST) }}
                            </a>
                        </p>
                    @endif
                @endif
            </div>
        </div>

        <p class="mb-4">{{ $selectedStage->tasks }}</p>

        @if ($selectedStage->company)
            <p class="text-sm text-gray-700">
                <strong>Locatie:</strong>
                {{ $selectedStage->company->street ?? '' }}
                {{ $selectedStage->company->streetNr ?? '' }},
                {{ $selectedStage->company->zip ?? '' }}
                {{ $selectedStage->company->town ?? '' }},
                {{ $selectedStage->company->country ?? '' }}
            </p>
        @endif

        @if ($selectedStage->studyfield)
            <p class="text-sm text-gray-700">
                <strong>Studierichting:</strong> {{ $selectedStage->studyfield->name }}
            </p>
        @endif

        <div class="mt-4 flex space-x-2">
            <form method="POST" action="{{ route('proposal.create') }}">
                @csrf
                <input type="hidden" name="stage_id" value="{{ $selectedStage->id }}">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Voorstel</button>
            </form>

        </div>
    </div>
@else
    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-600">Selecteer een stage om details te bekijken.</p>
    </div>
@endif

<x-app>
    <x-slot name="header">
        <h1 class="text-xl font-bold">Mijn Stageplaatsen</h1>
    </x-slot>

    @if (session('status'))
        <div class="mb-4 text-green-600">
            {{ session('status') }}
        </div>
    @endif


    <!-- 2-Column Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Left Column: Stage List -->
        <div class="col-span-1 space-y-4">
            @if ($stages->count() === 0)
                <div class="bg-white p-4 rounded shadow text-center">
                    <p class="text-gray-600 mb-4">Je hebt nog geen stageplaatsen aangemaakt.</p>
                    <a href="{{ route('company.stages.create') }}"
                        class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                        ➕ Stageplaats aanmaken
                    </a>
                </div>
            @else
                @foreach ($stages as $stage)
                    <div class="bg-white p-4 rounded shadow flex flex-col justify-between">
                        <div>
                            <h3 class="font-semibold text-lg">{{ $stage->title }}</h3>
                            <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                                {{ \Illuminate\Support\Str::limit($stage->tasks, 80) }}
                            </p>
                        </div>
                        <div class="mt-3 text-right">
                            <a href="{{ route('company.home', array_merge(request()->all(), ['selectedStage' => $stage->id])) }}"
                                class="text-blue-600 hover:underline">
                                Bekijk
                            </a>
                        </div>
                    </div>
                @endforeach

                <div class="mt-4">
                    {{ $stages->links() }}
                </div>
            @endif

        </div>

        <!-- Right Column: Stage Details or Edit -->
        <div class="col-span-1">
            @if ($selectedStage)
                <div class="bg-white p-6 rounded shadow">
                    <form method="POST" action="{{ route('company.stages.update', $selectedStage->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Titel')" />
                            <x-text-input id="title" name="title" type="text" class="w-full mt-1"
                                :value="old('title', $selectedStage->title)" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="tasks" :value="__('Taken')" />
                            <textarea id="tasks" name="tasks" rows="5"
                                class="w-full border-gray-300 rounded mt-1 shadow-sm focus:ring focus:ring-indigo-200" required>{{ old('tasks', $selectedStage->tasks) }}</textarea>
                        </div>

                        @if ($selectedStage->company)
                            <div class="mb-4">
                                <x-input-label :value="__('Locatie')" />
                                <p class="text-sm text-gray-700">
                                    {{ $selectedStage->company->street ?? '' }}
                                    {{ $selectedStage->company->streetNr ?? '' }},
                                    {{ $selectedStage->company->town ?? '' }}
                                </p>
                            </div>
                        @endif

                        <div class="flex justify-end space-x-2">
                            <x-primary-button>
                                {{ __('Opslaan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            @else
                <div class="bg-white p-4 rounded shadow">
                    <p class="text-gray-600">Selecteer een stage om de details te bekijken en te bewerken.</p>
                </div>
            @endif
        </div>
    </div>
</x-app>

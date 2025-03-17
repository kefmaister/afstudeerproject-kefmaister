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
                    <div class="bg-white p-4 rounded shadow relative">
                        <div class="flex justify-between items-start">
                            <h3 class="font-semibold text-lg">{{ $stage->title }}</h3>

                            <!-- Status Badge -->
                            @php
                                $status = [
                                    -1 => ['label' => 'Inactief', 'color' => 'bg-red-100 text-red-800'],
                                    0 => ['label' => 'Nieuw gemaakt', 'color' => 'bg-blue-100 text-blue-800'],
                                    1 => ['label' => 'In behandeling', 'color' => 'bg-yellow-100 text-yellow-800'],
                                    2 => ['label' => 'Goedgekeurd', 'color' => 'bg-green-100 text-green-800'],
                                ][$stage->active];
                            @endphp

                            <span class="text-xs px-2 py-1 rounded font-medium {{ $status['color'] }}">
                                {{ $status['label'] }}
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                            {{ \Illuminate\Support\Str::limit($stage->tasks, 80) }}
                        </p>

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
                    @if ($selectedStage->active === -1 && $selectedStage->reason)
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <strong>Stage afgekeurd:</strong> {{ $selectedStage->reason }}
                        </div>
                    @endif
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

                        <div class="mb-4">
                            <x-input-label for="studyfield_id" :value="__('Studierichting')" />
                            <select id="studyfield_id" name="studyfield_id"
                                class="w-full border-gray-300 rounded mt-1 shadow-sm focus:ring focus:ring-indigo-200">
                                @foreach ($studyfields as $field)
                                    <option value="{{ $field->id }}"
                                        {{ old('studyfield_id', $selectedStage->studyfield_id) == $field->id ? 'selected' : '' }}>
                                        {{ $field->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('studyfield_id')" class="mt-2" />
                        </div>


                        @if ($selectedStage->company)
                            <div class="mb-4">
                                <x-input-label :value="__('Locatie')" />
                                <div class="flex justify-between items-center">
                                    <p class="text-sm text-gray-700">
                                        {{ $selectedStage->company->street ?? '' }}
                                        {{ $selectedStage->company->streetNr ?? '' }},
                                        {{ $selectedStage->company->town ?? '' }}
                                    </p>
                                    <x-primary-button>
                                        {{ __('Opslaan') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        @endif

                    </form>
                    <div class="flex justify-between items-center mt-6">
                        @if ($selectedStage->active === -1)
                            <!-- Resend for reevaluation -->
                            <form method="POST" action="{{ route('company.stages.activate', $selectedStage->id) }}">
                                @csrf
                                @method('PUT')
                                <x-primary-button class="bg-yellow-500 hover:bg-yellow-600">
                                    {{ __('Opnieuw indienen') }}
                                </x-primary-button>
                            </form>
                        @elseif ($selectedStage->active === 0)
                            <!-- First-time submission -->
                            <form method="POST" action="{{ route('company.stages.activate', $selectedStage->id) }}">
                                @csrf
                                @method('PUT')
                                <x-primary-button class="bg-yellow-500 hover:bg-yellow-600">
                                    {{ __('Stage indienen') }}
                                </x-primary-button>
                            </form>
                        @endif

                        @if ($selectedStage->active >= 0)
                            <!-- Show Deactivate Button -->
                            <form method="POST" action="{{ route('company.stages.deactivate', $selectedStage->id) }}">
                                @csrf
                                @method('PUT')
                                <x-primary-button class="bg-red-500 hover:bg-red-600">
                                    {{ __('Stage deactiveren') }}
                                </x-primary-button>
                            </form>
                        @endif
                    </div>


                </div>
            @else
                <div class="bg-white p-4 rounded shadow">
                    <p class="text-gray-600">Selecteer een stage om de details te bekijken en te bewerken.</p>
                </div>
            @endif
        </div>
    </div>
</x-app>

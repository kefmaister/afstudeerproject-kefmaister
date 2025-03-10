<x-app>
    <x-slot name="header">
        <!-- Three-step header -->
        <div class="flex items-center space-x-8">
            <div class="text-xl font-semibold {{ $proposal->status === 'draft' ? 'text-gray-800' : 'text-gray-400' }}">
                1) Voorstel
            </div>
            <div class="text-xl font-semibold {{ $proposal->status === 'pending' ? 'text-gray-800' : 'text-gray-400' }}">
                – 2) Pending –
            </div>
            <div class="text-xl font-semibold {{ in_array($proposal->status, ['approved', 'denied']) ? 'text-gray-800' : 'text-gray-400' }}">
                – 3) Conclusie
            </div>
        </div>
    </x-slot>

    @if (session('status'))
        <div class="text-green-600 mb-4">
            {{ session('status') }}
        </div>
    @endif

    @php
        $status = $proposal->status ?? 'draft';
    @endphp

    @if ($status === 'draft')
        <!-- Draft: Student can fill out the form -->
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('student.proposal.store') }}" class="space-y-4">
                @csrf

                <!-- Row 1: Company Name, Street, Nr -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Bedrijf Naam -->
                    <div>
                        <label for="company_name" class="block font-semibold mb-1">Bedrijf Naam</label>
                        <input type="text" name="company_name" id="company_name" placeholder="Placeholder"
                            value="{{ old('company_name') }}" class="w-full border-gray-300 rounded p-2" />
                        @error('company_name')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>

                    </div>
                    <div>

                    </div>


                    <!-- Row 2: Gemeente, Postcode -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Straat -->
                        <div>
                            <label for="street" class="block font-semibold mb-1">Straat</label>
                            <input type="text" name="street" id="street" placeholder="Placeholder"
                                value="{{ old('street') }}" class="w-full border-gray-300 rounded p-2" />
                            @error('street')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nr -->
                        <div>
                            <label for="nr" class="block font-semibold mb-1">Nr</label>
                            <input type="text" name="nr" id="nr" placeholder="Placeholder"
                                value="{{ old('nr') }}" class="w-full border-gray-300 rounded p-2" />
                            @error('nr')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Postcode -->
                    <div>
                        <label for="zip" class="block font-semibold mb-1">Postcode</label>
                        <input type="text" name="zip" id="zip" placeholder="Placeholder"
                            value="{{ old('zip') }}" class="w-full border-gray-300 rounded p-2" />
                        @error('zip')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Gemeente -->
                    <div>
                        <label for="town" class="block font-semibold mb-1">Gemeente</label>
                        <input type="text" name="town" id="town" placeholder="Placeholder"
                            value="{{ old('town') }}" class="w-full border-gray-300 rounded p-2" />
                        @error('town')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Row 3: mentor naam, E-mail stagementor -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- mentor naam -->
                    <div>
                        <label for="stage_mentor" class="block font-semibold mb-1">Naam stagementor</label>
                        <input type="text" name="stage_mentor" id="stage_mentor" placeholder="Placeholder"
                            value="{{ old('stage_mentor') }}" class="w-full border-gray-300 rounded p-2" />
                        @error('stage_mentor')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- E-mail stagementor -->
                    <div>
                        <label for="stage_mentor_email" class="block font-semibold mb-1">E-mail stagementor</label>
                        <input type="email" name="stage_mentor_email" id="stage_mentor_email"
                            placeholder="Placeholder" value="{{ old('stage_mentor_email') }}"
                            class="w-full border-gray-300 rounded p-2" />
                        @error('stage_mentor_email')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Row 4: Taken toelichting -->
                <div>
                    <label for="tasks" class="block font-semibold mb-1">Taken toelichting</label>
                    <textarea name="tasks" id="tasks" placeholder="Placeholder" class="w-full border-gray-300 rounded p-2">{{ old('tasks') }}</textarea>
                    @error('tasks')
                        <div class="text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Row 5: Persoonlijke motivatie -->
                <div>
                    <label for="motivation" class="block font-semibold mb-1">Persoonlijke motivatie</label>
                    <textarea name="motivation" id="motivation" placeholder="Placeholder" class="w-full border-gray-300 rounded p-2">{{ old('motivation') }}</textarea>
                    @error('motivation')
                        <div class="text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit button -->
                <div class="mt-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                        Versturen
                    </button>
                </div>
            </form>
        </div>
    @elseif($status === 'pending')
        <!-- Pending: locked form + coordinator info -->
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Status: Pending</h2>

            <!-- Display locked fields (use same layout as draft, but disabled) -->
            @include('student.partials.proposal-locked-fields', ['proposal' => $proposal])

            <!-- Coordinator Info -->
            <h3 class="mt-4 font-semibold">Informatie</h3>
            <p>Coördinator: {{ $proposal->coordinator->name ?? 'N/A' }}</p>
            <p>Contact: {{ $proposal->coordinator->email ?? 'N/A' }}</p>
        </div>
    @elseif($status === 'approved')
        <!-- Approved: final view + instructions -->
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-green-600 mb-2">Goedgekeurd</h2>

            <!-- Display locked fields again -->
            @include('student.partials.proposal-locked-fields', ['proposal' => $proposal])

            <h3 class="mt-4 font-semibold">Feedback</h3>
            <p>{{ $proposal->feedback ?? 'Geen feedback' }}</p>

            <h3 class="mt-4 font-semibold">Volgende stappen</h3>
            <ol class="list-decimal list-inside">
                <li>Contract Downloaden</li>
                <li>Druk het twee maal af</li>
                <li>... etc.</li>
            </ol>
        </div>
    @endif
</x-app>

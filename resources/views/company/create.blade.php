<x-app>
    <x-slot name="header">
        <h1 class="text-xl font-bold">Nieuwe Stageplaats</h1>
    </x-slot>

    @if (session('status'))
        <div class="mb-4 text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <form method="POST" action="{{ route('company.stages.store') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="title" :value="__('Titel')" />
                <x-text-input id="title" name="title" type="text" class="w-full mt-1" required
                    :value="old('title')" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="tasks" :value="__('Taken')" />
                <textarea id="tasks" name="tasks" rows="6"
                    class="w-full border-gray-300 rounded mt-1 shadow-sm focus:ring focus:ring-indigo-200" required>{{ old('tasks') }}</textarea>
                <x-input-error :messages="$errors->get('tasks')" class="mt-2" />
            </div>

            <!-- Studyfield Select -->
            <div class="mb-4">
                <x-input-label for="studyfield_id" :value="__('Studierichting')" />
                <select id="studyfield_id" name="studyfield_id" required
                    class="w-full border-gray-300 rounded mt-1 shadow-sm focus:ring focus:ring-indigo-200">
                    <option value="" disabled selected>Kies een studierichting</option>
                    @foreach ($studyfields as $field)
                        <option value="{{ $field->id }}" {{ old('studyfield_id') == $field->id ? 'selected' : '' }}>
                            {{ $field->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('studyfield_id')" class="mt-2" />
            </div>

            <div class="flex justify-end">
                <x-primary-button>
                    {{ __('Stageplaats aanmaken') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app>

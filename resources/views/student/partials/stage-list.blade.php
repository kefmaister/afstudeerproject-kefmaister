<div class="space-y-4">
    @foreach ($stages as $stage)
        <div class="bg-white p-4 rounded shadow flex items-start gap-4">
            {{-- Company Logo --}}
            @if ($stage->company && $stage->company->logo)
                <img src="{{ asset('storage/' . $stage->company->logo) }}" alt="Company Logo"
                    class="h-16 w-16 rounded object-cover border" />
            @else
                <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center text-gray-500">
                    🏢
                </div>
            @endif

            {{-- Stage Info --}}
            <div class="flex flex-col justify-between flex-grow">
                <div>
                    <h3 class="font-semibold text-lg">{{ $stage->title }}</h3>
                    <p class="text-sm text-gray-600">
                        {{ $stage->company->company_name ?? 'Onbekend bedrijf' }}
                        @if ($stage->company?->town)
                            – {{ $stage->company->town }}
                        @endif
                    </p>
                    <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                        {{ \Illuminate\Support\Str::limit($stage->tasks, 80) }}
                    </p>
                </div>
                <div class="mt-3 text-right">
                    <a href="{{ route('student.home', array_merge(request()->all(), ['selectedStage' => $stage->id])) }}"
                        class="text-blue-600 hover:underline text-sm">
                        Bekijk
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-4">
    {{ $stages->links() }}
</div>

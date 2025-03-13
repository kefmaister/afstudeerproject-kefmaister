<div class="space-y-4">
    @foreach ($stages as $stage)
        <div class="bg-white p-4 rounded shadow flex flex-col justify-between">
            <div>
                @if ($stage->company->logo)
                    <img src="{{ $stage->company->logo }}" alt="Stage Logo" class="h-12 w-12 object-cover mb-2">
                @endif
                <h3 class="font-semibold text-lg">{{ $stage->title }}</h3>
                <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                    {{ \Illuminate\Support\Str::limit($stage->tasks, 80) }}
                </p>
            </div>
            <div class="mt-3 text-right">
                <a href="{{ route('student.home', array_merge(request()->all(), ['selectedStage' => $stage->id])) }}"
                    class="text-blue-600 hover:underline">
                    View
                </a>
            </div>
        </div>
    @endforeach
</div>
<div class="mt-4">
    {{ $stages->links() }}
</div>

@props(['message'])

@php
    use Illuminate\Support\Str;

    $message = $message ?? session('status');

    $colorClasses = 'bg-blue-100 text-blue-800 border-blue-300';

    if ($message) {
        $lower = strtolower($message);
        if (Str::contains($lower, ['success', 'succes', 'goedgekeurd'])) {
            $colorClasses = 'bg-green-100 text-green-800 border-green-300';
        } elseif (Str::contains($lower, ['pending', 'is ingediend', 'in behandeling'])) {
            $colorClasses = 'bg-yellow-100 text-yellow-800 border-yellow-300';
        } elseif (Str::contains($lower, ['afgekeurd', 'error', 'fout', 'mislukt', 'gedeactiveerd', 'inactief'])) {
            $colorClasses = 'bg-red-100 text-red-800 border-red-300';
        }
    }
@endphp


@if ($message)
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition.duration.500ms
        class="mb-4 px-4 py-2 rounded border shadow flex justify-between items-center {{ $colorClasses }}">
        <span>{{ $message }}</span>
        <button @click="show = false" class="ml-4 text-lg font-bold leading-none">&times;</button>
    </div>
@endif

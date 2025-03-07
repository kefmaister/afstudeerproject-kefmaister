@extends('coordinator.student-detail')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">CV</h2>
    @if ($cv)
        <iframe src="{{ asset('storage/' . $cv->file) }}" style="width: 100%; height: 600px;" frameborder="0"></iframe>
        <form action="{{ route('coordinator.cv.feedback', $cv->id) }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-4">
                <label for="feedback" class="block font-semibold mb-1">Feedback</label>
                <textarea name="feedback" id="feedback" rows="4" class="w-full border-gray-300 rounded p-2">{{ $cv->feedback }}</textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Verstuur Feedback</button>
        </form>
    @else
        <p>Geen CV geüpload.</p>
    @endif
@endsection

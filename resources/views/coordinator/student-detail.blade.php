<x-app>
    <x-slot name="header">
        <h1 class="text-xl font-bold">Student Details</h1>
        <div class="flex justify-between items-center">

            <div class="flex items-center space-x-4">
                <x-nav-link :href="route('coordinator.student.proposal', $student->id)" :active="request()->routeIs('coordinator.student.proposal', $student->id)">
                    {{ __('Voorstellen') }}
                </x-nav-link>
                <x-nav-link :href="route('coordinator.student.cv', $student->id)" :active="request()->routeIs('coordinator.student.cv', $student->id)">
                    {{ __('CV') }}
                </x-nav-link>
            </div>
            <div class="flex items-center space-x-6">
                @if ($prevStudentId)
                    <x-nav-link href="{{ route('coordinator.student.proposal', $prevStudentId) }}"
                        class="px-3 py-2 bg-gray-100 rounded hover:bg-gray-200">
                        ← Vorige
                    </x-nav-link>
                @endif
                <!-- Gebruik de student-dropdown component -->
                <x-student-dropdown :students="$students" :currentStudent="$student" />
                @if ($nextStudentId)
                    <x-nav-link href="{{ route('coordinator.student.proposal', $nextStudentId) }}"
                        class="px-3 py-2 bg-gray-100 rounded hover:bg-gray-200">
                        Volgende →
                    </x-nav-link>
                @endif
            </div>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        @yield('content')
    </div>

</x-app>

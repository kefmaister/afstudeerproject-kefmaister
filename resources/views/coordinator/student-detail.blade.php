<x-app>
    <x-slot name="header">
        <h1 class="text-xl font-bold">Student Details</h1>
        <div class="flex justify-between items-center">

            <div class="flex items-center space-x-4">
                <x-nav-link :href="route('coordinator.student.proposal', $student->id)" :active="request()->routeIs('coordinator.student.proposal', $student->id)">
                    {{ __('voorstellen') }}
                </x-nav-link>
                <x-nav-link :href="route('coordinator.student.cv', $student->id)" :active="request()->routeIs('coordinator.student.cv', $student->id)">
                    {{ __('cv') }}
                </x-nav-link>
            </div>
            <div class="flex items-center space-x-6">
                <!-- Use the student-dropdown component -->
                <x-student-dropdown :students="$students" :currentStudent="$student" />
            </div>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        @yield('content')
    </div>

</x-app>

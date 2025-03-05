<x-app>
    <x-slot name="header">
        <h1 class="text-xl font-bold">Coordinator Home</h1>
    </x-slot>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('coordinator.home') }}" class="mb-6">
        <x-coordinator-filters :search="request('search')" :studyfield="request('studyfield')" :studyfields="$studyfields" :proposalStatus="request('proposal_status')"
            :contractStatus="request('contract_status')" />
    </form>

    <!-- Results Table -->
    <div class="bg-white p-4 rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-50">
                    <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                        Student
                    </th>
                    <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                        Voorstel Status
                    </th>
                    <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                        Contract Status
                    </th>
                    <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                        Klasgroep
                    </th>
                    <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($students as $student)
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">
                            {{ $student->user->firstname . ' ' . $student->user->lastname }}
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            {{ $student->proposal->status ?? 'N/A' }}
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            {{ $student->contract_status ?? 'N/A' }}
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            {{ $student->studyfield->name ?? 'N/A' }}
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <!-- Example action link to view the student's proposal -->
                            <a href="#" class="text-blue-600 hover:underline">View</a>
                            <!-- Add more actions as needed -->
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-gray-500">
                            Geen resultaten gevonden
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $students->links() }}
        </div>
    </div>
</x-app>

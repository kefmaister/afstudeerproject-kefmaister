<x-app>
    <div x-data="{ open: false, formAction: '' }">
        <x-slot name="header">
            <h1 class="text-xl font-bold">Inbox</h1>
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <x-nav-link :href="route('coordinator.inbox.companies')" :active="request()->routeIs('coordinator.inbox.companies')">
                        {{ __('Companies') }}
                        <span class="ml-1 bg-blue-500 text-white text-xs font-bold rounded-full px-2">
                            {{ count($pendingCompanies) }}
                        </span>
                    </x-nav-link>
                    <x-nav-link :href="route('coordinator.inbox.stages')" :active="request()->routeIs('coordinator.inbox.stages')">
                        {{ __('Stages') }}
                        <span class="ml-1 bg-blue-500 text-white text-xs font-bold rounded-full px-2">
                            {{ count($pendingStages) }}
                        </span>
                    </x-nav-link>
                </div>
            </div>
        </x-slot>

        @if (session('status'))
            <div class="text-green-600 mb-4">
                {{ session('status') }}
            </div>
        @endif

        <!-- Deny Modal Component -->
        <div x-cloak>
            <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-40"></div>

            <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white w-full max-w-md p-6 rounded-lg shadow">
                    <h2 class="text-lg font-bold mb-4">Deny Company</h2>
                    <form :action="formAction" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <input type="text" name="reason" placeholder="Reason for denial" required
                            class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" />
                        <div class="flex justify-end gap-2">
                            <button type="button" @click="open = false"
                                class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-800">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 rounded bg-red-600 hover:bg-red-700 text-white font-semibold">
                                Deny
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            @if (request()->routeIs('coordinator.inbox.companies'))
                <h2 class="text-lg font-semibold mb-4">Pending Companies</h2>
                @foreach ($pendingCompanies as $company)
                    <div
                        class="border-l-4 border-blue-500 bg-white p-4 rounded shadow mb-4 flex justify-between items-start">
                        <div>
                            <h3 class="text-md font-bold text-gray-800">{{ $company->company_name }}</h3>
                            <p class="text-sm text-gray-600">Town: {{ $company->town }}</p>
                            <p class="text-sm text-gray-600">VAT: {{ $company->company_vat }}</p>
                            <p class="text-sm text-gray-600">Email: {{ $company->user->email ?? 'N/A' }}</p>
                        </div>
                        <div class="flex gap-2">
                            <!-- Approve Button -->
                            <form method="POST"
                                action="{{ route('coordinator.inbox.approve.company', $company->id) }}">
                                @csrf @method('PUT')
                                <button type="submit"
                                    class="inline-flex items-center gap-2 px-4 py-2 h-10 bg-green-600 text-white text-sm font-semibold rounded hover:bg-green-700 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Approve
                                </button>
                            </form>

                            <!-- Deny Button -->
                            <button
                                @click="open = true; formAction = '{{ route('coordinator.inbox.deny.company', $company->id) }}'"
                                type="button"
                                class="inline-flex items-center gap-2 px-4 py-2 h-10 bg-red-600 text-white text-sm font-semibold rounded hover:bg-red-700 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Deny
                            </button>
                        </div>
                    </div>
                @endforeach
            @elseif(request()->routeIs('coordinator.inbox.stages'))
                <h2 class="text-lg font-semibold mb-4">Pending Stages</h2>
                @foreach ($pendingStages as $stage)
                    <div class="bg-gray-50 p-4 rounded shadow mb-4">
                        <p><strong>Title:</strong> {{ $stage->title }}</p>
                        <p><strong>Tasks:</strong> {{ $stage->tasks }}</p>
                        <p><strong>Company:</strong> {{ $stage->company->company_name ?? '' }}</p>
                        <div class="mt-2 flex space-x-2">
                            <form method="POST" action="{{ route('coordinator.inbox.approve.stage', $stage->id) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                                    Approve
                                </button>
                            </form>
                            <form method="POST" action="{{ route('coordinator.inbox.deny.stage', $stage->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="text" name="reason" placeholder="Denial reason" required
                                    class="border p-1 rounded mr-2">
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                                    Deny
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app>

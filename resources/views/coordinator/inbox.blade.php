<x-app>
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

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        @if (request()->routeIs('coordinator.inbox.companies'))
            <h2 class="text-lg font-semibold mb-4">Pending Companies</h2>
            @foreach ($pendingCompanies as $company)
                <div class="bg-gray-50 p-4 rounded shadow mb-4">
                    <p><strong>Name:</strong> {{ $company->company_name }}</p>
                    <p><strong>Town:</strong> {{ $company->town }}</p>
                    <p><strong>Email:</strong> {{ $company->user->email ?? 'N/A' }}</p>
                    <div class="mt-2 flex space-x-2">
                        <form method="POST" action="{{ route('coordinator.inbox.approve.company', $company->id) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                                Approve
                            </button>
                        </form>
                        <form method="POST" action="{{ route('coordinator.inbox.deny.company', $company->id) }}">
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
</x-app>

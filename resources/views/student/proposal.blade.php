            @php
                $status = $proposal->status ?? 'draft';
            @endphp
            <x-app>
                <x-slot name="header">
                    <!-- Drie-stappen header -->
                    <div class="flex items-center space-x-8">

                        <div class="text-xl font-semibold {{ $status === 'draft' ? 'text-gray-800' : 'text-gray-400' }}">
                            1) Voorstel
                        </div>
                        <div
                            class="text-xl font-semibold {{ $status === 'pending' ? 'text-gray-800' : 'text-gray-400' }}">
                            – 2) In Behandeling –
                        </div>
                        <div
                            class="text-xl font-semibold {{ in_array($status, ['approved', 'denied']) ? 'text-gray-800' : 'text-gray-400' }}">
                            – 3) Conclusie
                        </div>
                    </div>
                </x-slot>

                @if (session('status'))
                    <div class="text-green-600 mb-4">
                        {{ session('status') }}
                    </div>
                @endif


                @if ($status === 'draft')
                    @include('student.partials.proposal-fields-draft', ['proposal' => $proposal])
                @elseif($status === 'pending')
                    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
                        <h2 class="text-lg font-semibold mb-2">Status: In Behandeling</h2>
                        @include('student.partials.proposal-locked-fields', ['proposal' => $proposal])
                        <h3 class="mt-4 font-semibold">Informatie</h3>
                        <p>Coördinator: {{ $proposal->coordinator->user->firstname ?? 'N.V.T.' }}
                            {{ $proposal->coordinator->user->lastname ?? '' }}</p>
                        <p>Contact: {{ $proposal->coordinator->user->email ?? 'N.V.T.' }}</p>
                    </div>
                @elseif($status === 'approved')
                    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
                        <h2 class="text-lg font-semibold text-green-600 mb-2">Goedgekeurd</h2>
                        @include('student.partials.proposal-locked-fields', ['proposal' => $proposal])
                        <h3 class="mt-4 font-semibold">Feedback</h3>
                        <p>{{ $proposal->feedback ?? 'Geen feedback' }}</p>
                        <h3 class="mt-4 font-semibold">Volgende Stappen</h3>
                        <ol class="list-decimal list-inside">
                            <li>Download het contract</li>
                            <li>Print het twee keer af</li>
                        </ol>
                    </div>
                @elseif($status === 'denied')
                    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
                        <h2 class="text-lg font-semibold text-red-600 mb-2">Afgekeurd</h2>
                        @include('student.partials.proposal-fields-draft', ['proposal' => $proposal])
                        <h3 class="mt-4 font-semibold">Feedback</h3>
                        <p>{{ $proposal->feedback ?? 'Geen feedback' }}</p>
                        <h3 class="mt-4 font-semibold">Volgende Stappen</h3>
                        <ol class="list-decimal list-inside">
                            <li>Wijzig je voorstel</li>
                            <li>Verstuur het opnieuw</li>
                        </ol>
                    </div>
                @endif

            </x-app>

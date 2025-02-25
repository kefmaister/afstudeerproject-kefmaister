<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Stageplatform Arteveldehogeschool</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind (via Vite or the CDN if you prefer) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Put your Tailwind <style> fallback or CDN link here if needed -->
    @endif
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 py-4 flex items-center justify-between">
                <!-- Left: Logo or site name -->
                <div class="text-xl font-bold text-[#FF2D20]">
                    Arteveldehogeschool
                </div>

                <!-- Right: Auth navigation -->
                <nav class="space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-gray-900">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow">
            <div class="mx-auto max-w-7xl px-4 py-8">
                <!-- Title / Introduction -->
                <h1 class="text-3xl font-bold text-center mb-8">
                    Welkom op het stageplatform van arteveldehogeschool
                </h1>

                <!-- Two-column layout -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div>
                        <!-- Hoofdwebsite -->
                        <h2 class="text-xl font-semibold mb-2">Hoofdwebsite</h2>
                        <p class="mb-6">
                            <a href="https://www.arteveldehogeschool.be" class="text-blue-600 hover:underline">
                                Arteveldehogeschool
                            </a>
                        </p>
                        <p class="mb-6">
                            <a href="https://programmeren.gent/" class="text-blue-600 hover:underline">
                                Programmeren
                            </a>
                        </p>
                        <p class="mb-6">
                            <a href="https://www.orm.gent/" class="text-blue-600 hover:underline">
                                Organisatie en Management
                            </a>
                        </p>

                        <!-- Opleidingen -->
                        <h2 class="text-xl font-semibold mb-2">Opleidingen</h2>
                        <p class="mb-6">
                            <a href="https://www.arteveldehogeschool.be/nl/opleidingen"
                                class="text-blue-600 hover:underline">
                                Artevelde hogeschool opleidingen
                            </a>
                        </p>

                        <!-- Recente bedrijven -->
                        <h2 class="text-xl font-semibold mb-2">Recente bedrijven</h2>
                        <div class="space-y-2">
                            <div class="bg-white p-4 shadow rounded">
                                Nieuwe Stage bedrijf
                            </div>
                            <div class="bg-white p-4 shadow rounded">
                                Nieuwe Stage bedrijf
                            </div>
                            <div class="bg-white p-4 shadow rounded">
                                Nieuwe Stage bedrijf
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <h2 class="text-xl font-semibold mb-4">De coördinators</h2>

                        <!-- Coordinator Card Example 1 -->
                        <div class="bg-white p-4 shadow rounded mb-4">
                            <div class="font-semibold">Inge De Canck</div>
                            <div class="text-sm text-gray-600">
                                inge.decanck@arteveldehs.be
                            </div>
                        </div>

                        <!-- Coordinator Card Example 2 -->
                        <div class="bg-white p-4 shadow rounded mb-4">
                            <div class="font-semibold">Voorbeeld Coördinator</div>
                            <div class="text-sm text-gray-600">
                                coordinator@arteveldehs.be
                            </div>
                        </div>

                        <!-- Add more coordinators as needed -->
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white">
            <div class="mx-auto max-w-7xl px-4 py-4 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Arteveldehogeschool. Alle rechten voorbehouden.
            </div>
        </footer>
    </div>
</body>

</html>

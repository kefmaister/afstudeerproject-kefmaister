<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <!-- Logo -->
        <div>
            <a href="/">
                <x-application-logo class="w-auto h-auto fill-current text-[#FF2D20]" />
            </a>
        </div>

        <!-- Card Container -->
        <div class="max-w-md w-full bg-white p-6 rounded shadow mt-6">
            {{ $slot }}
        </div>
    </div>
</body>

</html>

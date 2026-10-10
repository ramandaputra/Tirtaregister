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

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
</head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center sm:items-start pt-6 sm:pt-0 relative px-6 sm:px-16 md:px-24 lg:px-40">
            
            <!-- Background Image -->
            <div class="fixed inset-0 z-0">
                <img src="{{ asset('img/background.jpg') }}" class="w-full h-full object-cover" alt="Background">
                <div class="absolute inset-0 bg-black/50"></div>
            </div>
            
            <!-- Logo Container -->
            <div class="w-full sm:max-w-md flex justify-center sm:justify-start mb-4 relative z-10">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-white drop-shadow-md" />
                </a>
            </div>

            <!-- Login Form Container -->
            <div class="w-full sm:max-w-md px-6 py-8 bg-white/60 backdrop-blur-md shadow-2xl overflow-hidden rounded-2xl border border-white/30 relative z-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

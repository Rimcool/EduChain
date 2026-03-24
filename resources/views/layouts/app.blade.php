<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EduChain') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white">
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-gradient-to-r from-green-600 via-blue-600 to-purple-600 shadow-xl">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="relative">
            <!-- Animated background elements -->
            <div class="fixed inset-0 pointer-events-none overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full">
                    <div class="absolute top-20 left-10 w-72 h-72 bg-green-500/10 rounded-full blur-3xl animate-pulse"></div>
                    <div class="absolute top-40 right-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
                    <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl animate-pulse delay-500"></div>
                </div>
            </div>
            
            <div class="relative z-10">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>

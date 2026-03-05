<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EduChain') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    <style>
        :root {
            --bg-dark: #0f172a;
            --bg-panel: #111827;
            --text-primary: #e5e7eb;
            --text-secondary: #9ca3af;
            --accent-green: #10b981;
            --accent-red: #ef4444;
            --accent-yellow: #f59e0b;
            --border: #1f2937;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-primary);
            font-family: 'DM Sans', system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
        }

        .navbar {
            background: linear-gradient(180deg, rgba(17, 24, 39, 0.95), rgba(17, 24, 39, 0.85));
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
        }

        .sidebar {
            background: linear-gradient(180deg, rgba(17, 24, 39, 0.95), rgba(17, 24, 39, 0.85));
            border-right: 1px solid var(--border);
        }

        .card {
            background: var(--bg-panel);
            border: 1px solid var(--border);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-green), #06b6d4);
            border: none;
            color: white;
            font-weight: 600;
            transition: transform 0.1s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #374151;
            border: 1px solid var(--border);
            color: var(--text-primary);
        }

        .badge {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: var(--accent-green);
        }

        .badge-fake {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: var(--accent-red);
        }

        .badge-unconfirmed {
            background: rgba(245, 158, 11, 0.15);
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: var(--accent-yellow);
        }

        .terminal-text {
            font-family: 'Space Mono', ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            color: var(--accent-green);
            text-shadow: 0 0 10px rgba(16, 185, 129, 0.3);
        }

        .chain-block {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(6, 182, 212, 0.1));
            border: 1px solid rgba(16, 185, 129, 0.3);
            box-shadow: inset 0 0 10px rgba(16, 185, 129, 0.2);
        }

        .grade-badge {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            border: 1px solid rgba(245, 158, 11, 0.5);
            color: white;
            font-weight: 700;
            font-family: 'Syne', system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
        }

        .score-bar {
            background: linear-gradient(90deg, var(--accent-green), var(--accent-yellow), var(--accent-red));
            height: 4px;
        }

        .link-hover {
            transition: color 0.2s ease, transform 0.1s ease;
        }

        .link-hover:hover {
            color: var(--accent-green) !important;
            transform: translateX(2px);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
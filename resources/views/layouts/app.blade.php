<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Medik') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <style>
        .bg-white {
            background-color: #1f2937;
        }

        .font-bold {
            color: #d1d5db;
        }

        .text-gray-700 {
            color: #9a9b9e;
        }

        .text-green-500.ml-2 {
            color: yellow
        }

        td.border.px-4.py-2 {
            color: #9a9b9e;
        }

        .bg-white>div.mb-4>p {
            color: #9a9b9e;
        }

        .bg-blue-500 {
            background-color: #4674b6;
            transition: background 0.1s linear;
        }

        .bg-blue-500:hover {
            background-color: #29456c;
        }

        .bg-red-500 {
            background-color: #b65346;
            transition: background 0.1s linear;
        }

        .bg-red-500:hover {
            background-color: #782216;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
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

    @stack('modals')
    @stack('scripts')
    @stack('styles')

    @livewireScripts
</body>

</html>

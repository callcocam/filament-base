<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    {{-- @viteReactRefresh --}}
    {{-- @vite(['resources/css/app.css',  'resources/js/app.js','resources/js/components/menu/index.jsx' ]) --}}
    @vite(['resources/css/app.css'])
</head>

<body class="font-sans antialiased" x-data="settings">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="flex flex-col">
            <livewire:layout.navigation />
        </div>
        <!-- Page Heading -->
        @if (isset($header))
            {{ $header }}
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @vite(['resources/js/app.js'])
    @stack('modals')
    @stack('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Alpine.data('settings', () => ({

            }))

        })

        document.addEventListener('livewire:initialized', () => {
            // Runs immediately after Livewire has finished initializing
            // on the page...
            console.log('Livewire initialized')
        })
    </script>
</body>

</html>

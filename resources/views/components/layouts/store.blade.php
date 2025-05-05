<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Boma Books') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-white min-h-screen">
        <x-livewire.spa-mode>
            <!-- Navigation -->
            <x-store.navbar />

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <x-store.footer />
        </x-livewire.spa-mode>
        
        @livewireScripts
        
        <!-- Flash Messages -->
        @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}",
                    timer: 4000,
                    timerProgressBar: true
                });
            });
        </script>
        @endif

        @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('error') }}",
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>
        @endif

        @if (session('info'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Toast.fire({
                    icon: 'info',
                    title: "{{ session('info') }}",
                    timer: 2500,
                    timerProgressBar: true
                });
            });
        </script>
        @endif
    </body>
</html>
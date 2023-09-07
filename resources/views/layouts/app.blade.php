<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>G-RES</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Enlace al CDN de Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-lKLTSUjkpW1oxO6b0ch4+ZkQUh4Kp4PA9c6R9W6Fq1S9C2jcUj/LXMp0n+yWJpT1Itjx/yHTy8dprchvy0wGA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Estilos personalizados -->
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    {{-- <body class="font-sans antialiased"> --}}
    <body class="font-sans antialiased flex flex-col min-h-screen">
        {{-- <div class="min-h-screen bg-gray-100 dark:bg-gray-900"> --}}
        <div class="flex-grow">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            {{-- <main> --}}
            <main class="flex-grow">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-gray-200 dark:bg-gray-700 py-4 text-center">
                <div class="max-w-7xl mx-auto">
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        Este sistema es desarrollado y actualizado en la División del Sistema Universidad Abierta de la Facultad de Psicología de la Universidad Nacional Autónoma de México. Todos los derechos reservados 2023.
                    </p>
                </div>
            </footer>
        </div>
    </body>
</html>

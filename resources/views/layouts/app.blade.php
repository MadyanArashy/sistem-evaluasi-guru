<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
        <title>Dashboard Admin - SMK Pesat</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
        <style>
            @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
            }
            .floating-icon {
            animation: float 3s ease-in-out infinite;
            }
        </style>
    </head>
    <body x-data="{ sidebarOpen: true }"  class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Navbar -->
            <nav class="fixed top-0 left-0 right-0 bg-white/90 backdrop-blur border-b border-gray-200 z-50">
            <div class="flex items-center justify-between px-6 py-4">
                <!-- Hamburger for mobile -->
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-700 mr-2">
                <i class="fas fa-bars text-xl"></i>
                </button>

                <span class="font-bold text-lg text-gray-800">
                <i class="fas fa-chart-line text-blue-600 mr-2"></i>
                Dashboard Overview
                </span>

                <button class="btn bg-gray-100 rounded-full w-10 h-10 flex items-center justify-center">
                <i class="fas fa-bell"></i>
                </button>
            </div>
            </nav>

            <!-- Page Content -->
            <main class="font-sans-aliased">
                @include('layouts.navigation')
                <div :class="{ 'lg:ml-[250px]': sidebarOpen }" class="transition-all duration-300 mt-[70px] p-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>

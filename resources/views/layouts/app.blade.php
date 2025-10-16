<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Connecting-U Website Kolaborasi Inovatif')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">     
</head>
<body class="bg-gray-50 min-h-screen font-sans antialiased">
    <!-- NAVBAR -->
    <nav class="bg-white shadow mb-8">
        <div class="max-w-6xl mx-auto px-5 py-4 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <img src="{{ asset('assets/logo-dashboard.png') }}" alt="Logo" class="h-9 w-9 object-contain">
                <a href="/" class="text-xl font-bold text-blue-700">Connecting-U</a>
            </div>
            <!-- Navbar Menu -->
            <div class="flex space-x-4 items-center">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-500 font-medium">Beranda</a>
                <a href="{{ route('projects.index') }}" class="hover:text-blue-500 font-medium">Project/Tim</a>
                <a href="{{ route('events.index') }}" class="hover:text-blue-500 font-medium">Lomba/Event</a>
                <!-- Akun/Profil (langsung link ke edit profil) -->
                <a href="{{ route('profile.index') }}" class="flex items-center space-x-2 hover:text-blue-500 font-medium">
                    <img src="{{ auth()->user()->profile_photo_url ?? asset('assets/images/avatar-default.png') }}" class="h-8 w-8 rounded-full border" />
                    <span>{{ auth()->user()->name ?? 'Akun' }}</span>
                </a>
            </div>
            </div>
        </div>
    </nav>
    <!-- END NAVBAR -->

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-gray-400 py-10">
        <div class="max-w-6xl mx-auto px-4 flex flex-col items-center">
            <!-- Menu Links -->
            <div class="flex space-x-8 mb-6 text-lg">
                <a href="{{ route('teams.create') }}" class="hover:text-gray-200 transition">Buat Tim</a>
                <a href="#" class="hover:text-gray-200 transition">Blog</a>
                <a href="#" class="hover:text-gray-200 transition">Jobs</a>
                <a href="#" class="hover:text-gray-200 transition">Press</a>
                <a href="#" class="hover:text-gray-200 transition">Accessibility</a>
                <a href="#" class="hover:text-gray-200 transition">Partners</a>
            </div>
            <!-- Social Icons -->
            <div class="flex space-x-8 my-3">
                <!-- Social SVGs here, as in your original code -->
            </div>
            <!-- Copyright -->
            <div class="mt-6 text-base text-gray-400">
                © 2024 Your Company, Inc. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>

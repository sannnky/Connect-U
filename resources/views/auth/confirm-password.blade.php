<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Kata Sandi - Connecting-U</title>
    
    <!-- Memuat Tailwind CSS melalui CDN untuk memastikan tampilan langsung bagus -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <!-- Konfigurasi Tailwind untuk menggunakan font yang sama dengan halaman welcome -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui'],
                    },
                },
            },
        }
    </script>
    
    <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
</head>
<body class="antialiased font-sans">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            
            <div class="relative w-full max-w-xl px-6 lg:max-w-7xl">
                <header class="grid items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <a href="/" class="flex items-center space-x-3">
                            <img src="{{ asset('assets/logo-dashboard.png') }}" alt="Logo" class="h-12 w-12 object-contain">
                            <span class="text-2xl font-bold text-blue-700 dark:text-blue-400">Connecting-U</span>
                        </a>
                    </div>
                </header>

                <main class="mt-6">
                    <!-- Form Card -->
                    <div class="w-full sm:max-w-lg mx-auto p-8 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                        
                        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-200 mb-4">Konfirmasi Kata Sandi</h2>
                        
                        <div class="mb-4 text-sm text-center text-gray-600 dark:text-gray-400">
                            {{ __('Ini adalah area aman aplikasi. Silakan konfirmasi kata sandi Anda sebelum melanjutkan.') }}
                        </div>

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <!-- Password -->
                            <div>
                                <x-input-label for="password" :value="__('Kata Sandi')" />

                                <x-text-input id="password" class="block mt-1 w-full"
                                              type="password"
                                              name="password"
                                              required autocomplete="current-password" 
                                              placeholder="Masukkan kata sandi Anda"/>

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="flex justify-end mt-4">
                                <x-primary-button>
                                    {{ __('Konfirmasi') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </main>

                <footer class="py-16 text-center text-sm text-black/70 dark:text-white/70">
                    © {{ date('Y') }} Connecting-U. Hak Cipta Dilindungi.
                </footer>
            </div>
        </div>
    </div>
</body>
</html>

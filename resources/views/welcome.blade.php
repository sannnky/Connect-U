<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-g">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Selamat Datang di Connecting-U</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
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
    </head>
    <body class="antialiased font-sans">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <div class="relative min-h-screen flex flex-col items-center justify-center">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                             <a href="/" class="text-2xl font-bold text-blue-700 dark:text-blue-400">Connecting-U</a>
                        </div>
                    </header>

                    <main class="mt-6">
                       <div class="w-full max-w-md mx-auto p-6">
                            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-8 text-center">
                                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-2">Selamat Datang!</h1>
                                <p class="text-gray-600 dark:text-gray-400 mb-8">Silakan masuk untuk melanjutkan atau buat akun baru jika Anda belum terdaftar.</p>

                                <div class="flex flex-col space-y-4">
                                    {{-- Tombol Login --}}
                                    @if (Route::has('login'))
                                        <a href="{{ route('login') }}" class="w-full px-4 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-200">
                                            Masuk (Login)
                                        </a>
                                    @endif

                                    {{-- Tombol Register --}}
                                     @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="w-full px-4 py-3 bg-gray-200 text-gray-800 font-semibold rounded-lg shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75 transition duration-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                                            Daftar (Register)
                                        </a>
                                    @endif
                                </div>
                            </div>
                       </div>
                    </main>

                    <footer class="py-16 text-center text-sm text-black/70 dark:text-white/70">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>

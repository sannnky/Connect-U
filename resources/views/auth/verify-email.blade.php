<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Connecting-U</title>
    
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
                        
                        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-200 mb-4">Verifikasi Email Anda</h2>

                        <div class="mb-4 text-sm text-center text-gray-600 dark:text-gray-400">
                            {{ __('Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan? Jika Anda tidak menerima email, kami akan dengan senang hati mengirimkan yang lain.') }}
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-center text-green-600 dark:text-green-400">
                                {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                            </div>
                        @endif

                        <div class="mt-4 flex items-center justify-between">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <div>
                                    <x-primary-button>
                                        {{ __('Kirim Ulang Email Verifikasi') }}
                                    </x-primary-button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                    {{ __('Keluar (Log Out)') }}
                                </button>
                            </form>
                        </div>
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

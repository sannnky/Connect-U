<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - Connecting-U</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
    
    <!-- Tailwind -->
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
                
                <!-- Header -->
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <a href="/" class="flex items-center space-x-3">
                            <img src="{{ asset('assets/logo-dashboard.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                            <span class="text-2xl font-bold text-blue-700 dark:text-blue-400">Connecting-U</span>
                        </a>
                    </div>
                </header>

                <!-- Main -->
                <main class="mt-6">
                    <div class="w-full max-w-md mx-auto p-6">
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-8 text-center">
                            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-2">Masuk ke Akun Anda</h1>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">Gunakan email dan kata sandi Anda untuk melanjutkan.</p>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email -->
                                <div class="text-left">
                                    <x-input-label for="email" :value="__('Alamat Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full"
                                                  type="email" name="email"
                                                  :value="old('email')" required autofocus
                                                  autocomplete="username"
                                                  placeholder="contoh@email.com" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div class="mt-4 text-left">
                                    <x-input-label for="password" :value="__('Kata Sandi')" />
                                    <x-text-input id="password" class="block mt-1 w-full"
                                                  type="password" name="password"
                                                  required autocomplete="current-password"
                                                  placeholder="Masukkan kata sandi Anda" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Remember Me -->
                                <div class="flex items-center justify-between mt-4 text-sm">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700" name="remember">
                                        <span class="ml-2 text-gray-600 dark:text-gray-400">Ingat saya</span>
                                    </label>

                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                            Lupa kata sandi?
                                        </a>
                                    @endif
                                </div>

                                <!-- Submit -->
                                <div class="mt-6">
                                    <x-primary-button class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-200">
                                        {{ __('Masuk') }}
                                    </x-primary-button>
                                </div>

                                <!-- Register link -->
                                @if (Route::has('register'))
                                    <p class="mt-6 text-sm text-gray-600 dark:text-gray-400">
                                        Belum punya akun?
                                        <a href="{{ route('register') }}" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline">
                                            Daftar di sini
                                        </a>
                                    </p>
                                @endif
                            </form>
                        </div>
                    </div>
                </main>

                <!-- Footer -->
                <footer class="py-16 text-center text-sm text-black/70 dark:text-white/70">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </footer>
            </div>
        </div>
    </div>
</body>
</html>

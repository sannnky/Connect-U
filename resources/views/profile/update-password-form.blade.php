<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Ubah Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="block font-semibold mb-1">{{ __('Password Saat Ini') }}</label>
            <input id="current_password" name="current_password" type="password" class="w-full border rounded px-3 py-2" autocomplete="current-password" />
            @if($errors->updatePassword->get('current_password')) <p class="text-red-500 text-sm mt-1">{{ $errors->updatePassword->first('current_password') }}</p> @endif
        </div>

        <div>
            <label for="password" class="block font-semibold mb-1">{{ __('Password Baru') }}</label>
            <input id="password" name="password" type="password" class="w-full border rounded px-3 py-2" autocomplete="new-password" />
            @if($errors->updatePassword->get('password')) <p class="text-red-500 text-sm mt-1">{{ $errors->updatePassword->first('password') }}</p> @endif
        </div>

        <div>
            <label for="password_confirmation" class="block font-semibold mb-1">{{ __('Konfirmasi Password Baru') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="w-full border rounded px-3 py-2" autocomplete="new-password" />
            @if($errors->updatePassword->get('password_confirmation')) <p class="text-red-500 text-sm mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</p> @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">{{ __('Simpan') }}</button>
            @if (session('status') === 'password-updated')
                <p class="text-sm text-gray-600">{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>

<!-- filepath: c:\xampp\htdocs\Connecting-U\connecting-u\resources\views\profile\edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Edit Profil</h1>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="bio" class="block font-semibold mb-1">Bio</label>
            <textarea name="bio" id="bio" class="w-full border rounded px-3 py-2" rows="3">{{ old('bio', $user->bio ?? '') }}</textarea>
        </div>
        <div class="mb-4">
            <label for="avatar" class="block font-semibold mb-1">Avatar</label>
            <input type="file" name="avatar" id="avatar" class="w-full border rounded px-3 py-2">
            @if(!empty($user->avatar))
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="mt-2 h-16 w-16 rounded-full object-cover">
            @endif
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Simpan Perubahan</button>
        <a href="{{ url()->previous() }}" class="ml-3 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection
<!-- filepath: c:\xampp\htdocs\Connecting-U\connecting-u\resources\views\events\create.blade.php -->
@extends('layouts.app')

@section('title', 'Buat Event Baru')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Buat Event Baru</h1>
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nama Event</label>
            <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="description" id="description" class="w-full border rounded px-3 py-2" rows="4"></textarea>
        </div>
        <div class="mb-4">
            <label for="date" class="block font-semibold mb-1">Tanggal</label>
            <input type="date" name="date" id="date" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="location" class="block font-semibold mb-1">Lokasi</label>
            <input type="text" name="location" id="location" class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
        <a href="{{ route('events.index') }}" class="ml-3 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection
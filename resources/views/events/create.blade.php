@extends('layouts.app')

@section('title', 'Buat Event Baru')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Buat Event Baru</h1>

    {{-- Menampilkan error validasi jika ada --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nama Event</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="description" id="description" class="w-full border rounded px-3 py-2" rows="4">{{ old('description') }}</textarea>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="start_at" class="block font-semibold mb-1">Tanggal & Waktu Mulai</label>
                <input type="datetime-local" name="start_at" id="start_at" value="{{ old('start_at') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label for="end_at" class="block font-semibold mb-1">Tanggal & Waktu Selesai</label>
                <input type="datetime-local" name="end_at" id="end_at" value="{{ old('end_at') }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>
         <div class="mb-4">
            <label for="type" class="block font-semibold mb-1">Tipe Event</label>
            <select name="type" id="type" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Tipe --</option>
                <option value="Internal" {{ old('type') == 'Internal' ? 'selected' : '' }}>Internal</option>
                <option value="Eksternal" {{ old('type') == 'Eksternal' ? 'selected' : '' }}>Eksternal</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="category_id" class="block font-semibold mb-1">Kategori (Opsional)</label>
            <select name="category_id" id="category_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
        <a href="{{ route('events.index') }}" class="ml-3 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Buat Tim Baru')

@section('content')
<div class="max-w-xl mx-auto p-5">
    <div class="bg-white shadow-md rounded-lg p-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Buat Tim Baru</h1>
        <form action="{{ route('teams.store') }}" method="POST" class="space-y-4">
            @csrf
            
            {{-- Nama Tim --}}
            <div>
                <label for="name" class="block font-medium text-gray-700">Nama Tim</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" required autofocus>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description"
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center justify-end space-x-2 pt-4">
                <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 font-medium">
                    Batal
                </a>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 font-medium" type="submit">
                    Simpan Tim
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

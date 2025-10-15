@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto p-5">
    <h1 class="text-2xl font-bold mb-6">Buat Project Baru</h1>
    <form action="{{ route('projects.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="title" class="block font-medium">Judul Project</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror">
            @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="description" class="block font-medium">Deskripsi</label>
            <textarea name="description" id="description"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block font-medium">Tim</label>
            <select name="team_id" id="team_id"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('team_id') border-red-500 @enderror">
                <option value="">-- Pilih Tim --</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                @endforeach
            </select>
            @error('team_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block font-medium">Kategori</label>
            <select name="category_id" id="category_id"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category_id') border-red-500 @enderror">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block font-medium">Status</label>
            <select name="status" id="status"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                <option value="Berjalan" {{ old('status')=='Berjalan'?'selected':'' }}>Berjalan</option>
                <option value="Selesai" {{ old('status')=='Selesai'?'selected':'' }}>Selesai</option>
                <option value="Draft" {{ old('status')=='Draft'?'selected':'' }}>Draft</option>
            </select>
            @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex space-x-2">
            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" type="submit">Simpan</button>
            <a href="{{ route('projects.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-600">Batal</a>
        </div>
    </form>
</div>
@endsection

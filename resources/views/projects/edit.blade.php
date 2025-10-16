@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Edit Project: {{ $project->title }}</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
        </div>
    @endif

    <form action="{{ route('projects.update', $project->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="title" class="block font-semibold mb-1">Judul Project</label>
            <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label for="description" class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="description" id="description" class="w-full border rounded px-3 py-2" rows="4">{{ old('description', $project->description) }}</textarea>
        </div>
        <div>
            <label for="team_id" class="block font-semibold mb-1">Tim</label>
            <select name="team_id" id="team_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Tim --</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ old('team_id', $project->team_id) == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="category_id" class="block font-semibold mb-1">Kategori</label>
            <select name="category_id" id="category_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="status" class="block font-semibold mb-1">Status</label>
            <select name="status" id="status" class="w-full border rounded px-3 py-2" required>
                <option value="Draft" {{ old('status', $project->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                <option value="Berjalan" {{ old('status', $project->status) == 'Berjalan' ? 'selected' : '' }}>Berjalan</option>
                <option value="Selesai" {{ old('status', $project->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="flex items-center space-x-4">
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Update</button>
            <a href="{{ route('projects.show', $project->id) }}" class="text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Daftar Project')

@section('content')
<div class="max-w-6xl mx-auto p-5">
    <h1 class="text-2xl font-bold mb-6">Daftar Project</h1>
    <a class="mb-6 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition" href="{{ route('projects.create') }}">Tambah Project</a>
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-left">Judul</th>
                    <th class="py-2 px-4 text-left">Tim</th>
                    <th class="py-2 px-4 text-left">Kategori</th>
                    <th class="py-2 px-4 text-left">Status</th>
                    <th class="py-2 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr class="border-t">
                    <td class="py-2 px-4">{{ $project->title }}</td>
                    <td class="py-2 px-4">{{ $project->team->name ?? '-' }}</td>
                    <td class="py-2 px-4">{{ $project->category->name ?? '-' }}</td>
                    <td class="py-2 px-4">{{ $project->status }}</td>
                    <td class="py-2 px-4 space-x-2">
                        <a href="{{ route('projects.show', $project->id) }}" class="inline-block px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Detail</a>
                        <a href="{{ route('projects.edit', $project->id) }}" class="inline-block px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">Edit</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus project?')">
                            @csrf
                            @method('DELETE')
                            <button class="inline-block px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Belum ada project.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

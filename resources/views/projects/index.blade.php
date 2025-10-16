@extends('layouts.app')

@section('title', 'Daftar Project')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Project & Tim</h1>
        <a href="{{ route('projects.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Buat Project Baru
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 text-left">Nama Project</th>
                    <th class="py-2 px-4 text-left">Tim</th>
                    <th class="py-2 px-4 text-left">Kategori</th>
                    <th class="py-2 px-4 text-left">Status</th>
                    <th class="py-2 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr class="border-b">
                        <td class="py-2 px-4 font-medium">{{ $project->title }}</td>
                        <td class="py-2 px-4">{{ $project->team->name ?? 'N/A' }}</td>
                        <td class="py-2 px-4">{{ $project->category ?? 'N/A' }}</td>
                        <td class="py-2 px-4">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                @if($project->status == 'Selesai') bg-green-100 text-green-800
                                @elseif($project->status == 'Berjalan') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $project->status }}
                            </span>
                        </td>
                        <td class="py-2 px-4 flex space-x-2">
                            <a href="{{ route('projects.show', $project->id) }}" class="text-blue-500 hover:underline">Lihat</a>
                            <a href="{{ route('projects.edit', $project->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus project ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 px-4 text-center text-gray-500">
                            Belum ada project yang dibuat.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

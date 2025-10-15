<!-- filepath: c:\xampp\htdocs\Connecting-U\connecting-u\resources\views\events\index.blade.php -->
@extends('layouts.app')

@section('title', 'Daftar Event')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Event</h1>
    <a href="{{ route('events.create') }}" class="mb-6 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Buat Event Baru</a>
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-left">Nama Event</th>
                    <th class="py-2 px-4 text-left">Tanggal</th>
                    <th class="py-2 px-4 text-left">Lokasi</th>
                    <th class="py-2 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr class="border-t">
                    <td class="py-2 px-4">{{ $event->name }}</td>
                    <td class="py-2 px-4">{{ $event->date ?? '-' }}</td>
                    <td class="py-2 px-4">{{ $event->location ?? '-' }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('events.show', $event) }}" class="text-blue-600 hover:underline">Lihat</a>
                        <a href="{{ route('events.edit', $event) }}" class="ml-2 text-yellow-600 hover:underline">Edit</a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ml-2 text-red-600 hover:underline" onclick="return confirm('Yakin hapus event ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-4 text-center text-gray-500">Belum ada event.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
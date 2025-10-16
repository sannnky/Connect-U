@extends('layouts.app')

@section('title', 'Daftar Event')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Lomba & Event</h1>
        <a href="{{ route('events.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Buat Event Baru
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
                    <th class="py-2 px-4 text-left">Nama Event</th>
                    <th class="py-2 px-4 text-left">Tipe</th>
                    <th class="py-2 px-4 text-left">Tanggal Mulai</th>
                    <th class="py-2 px-4 text-left">Kategori</th>
                    <th class="py-2 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $event->name }}</td>
                        <td class="py-2 px-4"><span class="px-2 py-1 text-xs font-semibold rounded-full {{ $event->type == 'Internal' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">{{ $event->type }}</span></td>
                        <td class="py-2 px-4">{{ $event->start_at->format('d M Y, H:i') }}</td>
                        <td class="py-2 px-4">{{ $event->category->name ?? 'N/A' }}</td>
                        <td class="py-2 px-4 flex space-x-2">
                            <a href="{{ route('events.show', $event->id) }}" class="text-blue-500 hover:underline">Lihat</a>
                            <a href="{{ route('events.edit', $event->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 px-4 text-center text-gray-500">
                            Tidak ada event yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

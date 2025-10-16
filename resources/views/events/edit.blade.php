@extends('layouts.app')

@section('title', 'Detail Event: ' . $event->name)

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded shadow">
    <div class="flex justify-between items-start mb-4">
        <div>
            <h1 class="text-3xl font-bold mb-2">{{ $event->name }}</h1>
            <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $event->type == 'Internal' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                {{ $event->type }}
            </span>
        </div>
        <a href="{{ route('events.index') }}" class="text-gray-600 hover:underline">&larr; Kembali ke Daftar</a>
    </div>

    <div class="space-y-4 text-gray-700">
        <div>
            <h2 class="font-semibold">Deskripsi:</h2>
            <p>{{ $event->description ?? 'Tidak ada deskripsi.' }}</p>
        </div>
        <hr>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h3 class="font-semibold">Tanggal & Waktu Mulai:</h3>
                <p>{{ $event->start_at->format('l, d F Y - H:i') }} WIB</p>
            </div>
            @if($event->end_at)
            <div>
                <h3 class="font-semibold">Tanggal & Waktu Selesai:</h3>
                <p>{{ $event->end_at->format('l, d F Y - H:i') }} WIB</p>
            </div>
            @endif
        </div>
        <div>
            <h3 class="font-semibold">Kategori:</h3>
            <p>{{ $event->category->name ?? 'Tidak ada kategori' }}</p>
        </div>
    </div>

    <div class="mt-8 pt-4 border-t flex space-x-3">
        <a href="{{ route('events.edit', $event->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Edit Event</a>
        <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">Hapus Event</button>
        </form>
    </div>
</div>
@endsection

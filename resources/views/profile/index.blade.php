@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('content')
<div class="max-w-4xl mx-auto p-5 space-y-8">
    <div class="bg-white p-6 rounded-lg shadow flex items-center space-x-6">
        <img src="{{ $user->avatar ?? 'https://placehold.co/100x100/EBF4FF/7F9CF5?text=Avatar' }}" alt="Avatar" class="h-24 w-24 rounded-full border-4 border-blue-200">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }}</h1>
            <p class="text-gray-600">{{ $user->email }}</p>
            <p class="text-gray-500 mt-2 italic">"{{ $user->bio ?? 'Pengguna ini belum menambahkan bio.' }}"</p>
            <a href="{{ route('profile.edit') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 text-sm rounded hover:bg-blue-600 transition">
                Pengaturan Akun
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Tim Saya</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($teams as $team)
                <div class="bg-gray-50 p-4 rounded border border-gray-200">
                    <h3 class="font-semibold text-blue-700">{{ $team->name }}</h3>
                    <p class="text-sm text-gray-600 truncate">{{ $team->description }}</p>
                </div>
            @empty
                <p class="text-gray-500 col-span-full">Anda belum bergabung dengan tim manapun.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
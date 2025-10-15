<!-- filepath: c:\xampp\htdocs\Connecting-U\connecting-u\resources\views\profile\index.blade.php -->
@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow mt-8">
    <div class="flex flex-col items-center">
        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/images/avatar-default.png') }}" 
            alt="Avatar" class="h-24 w-24 rounded-full object-cover mb-4 border">
        <h2 class="text-xl font-bold mb-1">{{ $user->name }}</h2>
        <p class="text-gray-600 mb-1">{{ $user->email }}</p>
        <p class="text-gray-700 mb-4">{{ $user->bio ?? '-' }}</p>
        <div class="flex space-x-3">
            <a href="{{ route('profile.edit') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Edit Profil</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Logout</button>
            </form>
        </div>
    </div>
</div>
@endsection
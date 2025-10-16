@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-100">
                <div class="flex flex-col items-center text-center">
                    
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-32 h-32 rounded-full mb-4 object-cover">
                    @else
                        <div class="w-32 h-32 rounded-full bg-gray-700 flex items-center justify-center text-gray-400 mb-4">
                            <span class="text-4xl">?</span>
                        </div>
                    @endif

                    <h2 class="text-2xl font-semibold">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-400">{{ Auth::user()->email }}</p>
                    
                    {{-- Tampilkan Bio --}}
                    <p class="text-gray-300 mt-4 max-w-2xl">
                        {{ Auth::user()->bio ?: 'Pengguna ini belum menuliskan bio.' }}
                    </p>

                    <div class="mt-6">
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
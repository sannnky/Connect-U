@extends('layouts.app')

@section('title', 'Detail Project')

@section('content')
<div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            {{-- Bagian Notifikasi --}}
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            @if (session('info'))
                <div class="mb-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('info') }}</span>
                </div>
            @endif

            <div class="flex justify-between items-center mb-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $project->title }}</h1>
                    {{-- Tambahkan link ke halaman detail tim jika diinginkan --}}
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tim: {{ $project->team->name ?? 'N/A' }}</p>
                </div>
                <span class="px-3 py-1 text-sm font-semibold rounded-full 
                    @if($project->status == 'Selesai') bg-green-100 text-green-800 @endif
                    @if($project->status == 'Berjalan') bg-blue-100 text-blue-800 @endif
                    @if($project->status == 'Draft') bg-gray-100 text-gray-800 @endif">
                    {{ $project->status }}
                </span>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Deskripsi</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ $project->description }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Kategori</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ $project->category->name ?? '-' }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <div class="mt-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-white">Progress & Timeline</h3>
            <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($project->progress as $prog)
                        <li class="py-3">
                            <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $prog->title }} ({{ \Carbon\Carbon::parse($prog->progress_date)->format('d M Y') }})</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $prog->body }}</p>
                        </li>
                    @empty
                        <li class="py-3 text-sm text-gray-500 dark:text-gray-400">Belum ada progress/timeline yang ditambahkan.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-start gap-x-4">
        <a href="{{ route('projects.index') }}" class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500">
            Kembali ke Daftar
        </a>

        @can('update', $project)
            {{-- Jika user punya izin update (anggota tim), tampilkan tombol Edit & Hapus --}}
            <a href="{{ route('projects.edit', $project->id) }}" class="rounded-md bg-yellow-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-600">
                Edit Project
            </a>
            
            @can('delete', $project)
                {{-- Tombol Hapus hanya untuk leader (sesuai Policy) --}}
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500">
                        Hapus Project
                    </button>
                </form>
            @endcan
        @else
            {{-- Jika user BUKAN anggota tim --}}
            @if(Auth::user()->hasPendingJoinRequestFor($project->team))
                {{-- Jika sudah kirim permohonan, tombol dinonaktifkan --}}
                <button class="rounded-md bg-gray-400 px-3 py-2 text-sm font-semibold text-white shadow-sm cursor-not-allowed" disabled>
                    Permohonan Terkirim
                </button>
            @else
                {{-- Jika belum, tampilkan tombol untuk kirim permohonan --}}
                <form action="{{ route('join-requests.store', $project->team->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500">
                        Ajukan Permohonan Bergabung
                    </button>
                </form>
            @endif
        @endcan
    </div>
</div>
@endsection
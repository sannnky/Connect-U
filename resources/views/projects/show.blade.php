@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-5">
    <h1 class="text-2xl font-bold mb-6">Detail Project</h1>
    <div class="bg-white rounded shadow p-6 mb-4">
        <h3 class="text-lg font-bold mb-2">{{ $project->title }}</h3>
        <p class="mb-2"><span class="font-semibold">Deskripsi:</span> {{ $project->description }}</p>
        <p class="mb-2"><span class="font-semibold">Tim:</span> {{ $project->team->name ?? '-' }}</p>
        <p class="mb-2"><span class="font-semibold">Kategori:</span> {{ $project->category->name ?? '-' }}</p>
        <p class="mb-2"><span class="font-semibold">Status:</span> {{ $project->status }}</p>
    </div>

    <div class="mb-4 flex space-x-2">
        <a href="{{ route('projects.edit', $project->id) }}" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">Edit</a>
        <a href="{{ route('projects.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-600">Kembali ke Daftar</a>
    </div>

    <div class="bg-white rounded shadow p-6 mb-4">
        <h4 class="font-bold mb-2">Proposal Terkait</h4>
        <ul>
            @forelse($project->proposals as $proposal)
            <li class="mb-1">
                {{ $proposal->filename }} (<span class="text-sm text-gray-600">{{ $proposal->status }}</span>)
            </li>
            @empty
            <li class="text-gray-400">Belum ada proposal.</li>
            @endforelse
        </ul>
    </div>

    <div class="bg-white rounded shadow p-6">
        <h4 class="font-bold mb-2">Progress & Timeline</h4>
        <ul>
            @forelse($project->progress as $prog)
            <li class="mb-1 border-b last:border-none pb-2">
                <span class="font-semibold">{{ $prog->progress_date }}</span> - {{ $prog->title }}<br>
                <span class="text-gray-600">{{ $prog->body }}</span>
            </li>
            @empty
            <li class="text-gray-400">Belum ada progress/timeline.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection

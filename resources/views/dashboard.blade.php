<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ ('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ ("You're logged in!") }}
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Announcement Section --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">📢 Pengumuman Internal</h3>
                        <div class="space-y-4">
                            @forelse ($announcements as $announcement)
                                <div class="border-l-4 border-blue-500 pl-4">
                                    <h4 class="font-bold">{{ $announcement->title }}</h4>
                                    <p class="text-sm text-gray-600">{{ $announcement->body }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500">Tidak ada pengumuman terbaru.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Category Section --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">🗂️ Kategori Proyek / Diskusi / Tugas</h3>
                        <div class="flex justify-between items-center">
                            <p>Total Kategori:</p>
                            <p class="font-bold text-2xl">{{ $categoryCount ?? 0 }}</p>
                        </div>
                        <div class="mt-4">
                            <h4 class="font-semibold">Filter Cepat:</h4>
                            <div class="flex flex-wrap gap-2 mt-2">
                                @forelse ($categories as $category)
                                    <a href="#" class="px-3 py-1 bg-gray-200 text-gray-800 rounded-full text-sm">{{ $category->name }}</a>
                                @empty
                                    <p class="text-gray-500">Tidak ada kategori.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Event Section --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">📅 Jadwal atau Kegiatan</h3>
                        <ul>
                            @forelse ($upcomingEvents as $event)
                                <li class="mb-2">
                                    <strong>{{ $event->name }}</strong> - {{ $event->start_at->format('d M Y') }}
                                </li>
                            @empty
                                <li class="text-gray-500">Tidak ada jadwal kegiatan mendatang.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                {{-- Invitation Section --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">✉️ Undangan ke Proyek / Tim</h3>
                        <ul>
                            @forelse ($invitations as $invitation)
                                <li class="mb-2">
                                    Undangan ke tim <strong>{{ $invitation->team->name }}</strong>. Status: <span class="font-semibold">{{ $invitation->status }}</span>
                                </li>
                            @empty
                                <li class="text-gray-500">Tidak ada undangan.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                {{-- Progress Section --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">📈 Progress Tugas / Proyek</h3>
                        @forelse ($projectsWithProgress as $project)
                            <div class="mb-4">
                                <div class="flex justify-between mb-1">
                                    <span class="text-base font-medium text-blue-700 dark:text-white">{{ $project->title }}</span>
                                    <span class="text-sm font-medium text-blue-700 dark:text-white">{{ round($project->progress) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $project->progress }}%"></div>
                                </div>
                            </div>
                        @empty
                             <p class="text-gray-500">Tidak ada progress proyek untuk ditampilkan.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<?php

namespace App\Http\Controllers;

use App\Models\announcements;
use App\Models\categories;
use App\Models\Category;
use App\Models\Event;
use App\Models\invitations;
use App\Models\memberships; // Tambahkan ini
use App\Models\project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data untuk section pengumuman
        $announcements = announcements::latest()->take(5)->get();

        // Mengambil data untuk section kategori
        $categories = Category::all();
        $categoryCount = $categories->count();

        // Mengambil data untuk section jadwal/kegiatan
        $upcomingEvents = event::where('start_at', '>=', now())->orderBy('start_at', 'asc')->take(5)->get();

        // Mengambil data untuk section undangan
        $invitations = invitations::where('user_id', Auth::id())->where('status', 'pending')->latest()->get();

        // --- INI BAGIAN YANG DIPERBAIKI ---
        // Mengambil data untuk section progress proyek
        // 1. Dapatkan ID dari semua tim dimana user adalah anggota
        $userTeamIds = memberships::where('user_id', Auth::id())->pluck('team_id');

        // 2. Dapatkan proyek yang dimiliki oleh tim-tim tersebut
        $projectsWithProgress = project::whereIn('team_id', $userTeamIds)
            ->get()
            ->map(function ($project) {
                // Logika kalkulasi progress ini adalah contoh.
                // Anda HARUS menyesuaikannya dengan relasi 'tasks' yang Anda miliki.
                // Misal: $project->tasks->count() dan $project->tasks->where('status', 'completed')->count()
                $totalTasks = $project->tasks_count ?? 1; // Ganti dengan relasi yang benar
                $completedTasks = $project->completed_tasks_count ?? 0; // Ganti dengan relasi yang benar
                
                // Hindari pembagian dengan nol
                if ($totalTasks > 0) {
                    $project->progress = ($completedTasks / $totalTasks) * 100;
                } else {
                    $project->progress = 0;
                }
                
                return $project;
            });

        // Kirim semua data yang dibutuhkan oleh view
        return view('dashboard', compact(
            'announcements',
            'categories',
            'categoryCount',
            'upcomingEvents',
            'invitations',
            'projectsWithProgress'
        ));
    }
}
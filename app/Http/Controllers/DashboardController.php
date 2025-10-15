<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Team;
use App\Models\Event;
use App\Models\events;
use App\Models\teams;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Data statistik utama untuk dashboard
        $jumlahTim       = teams::count();
        $jumlahProject   = project::count();
        $jumlahEvent     = events::count();
        $projectAktif    = project::where('status', 'Berjalan')->count();
        $lombaAktif      = events::where('type', 'Eksternal')->where('end_at', '>=', now())->count();
        $highlightProject = project::orderBy('updated_at', 'desc')->take(3)->get();
        $jumlahUser      = user::count();

        // Kirim data ke view dashboard
        return view('dashboard', compact(
            'jumlahTim',
            'jumlahProject',
            'jumlahEvent',
            'projectAktif',
            'lombaAktif',
            'highlightProject',
            'jumlahUser'
        ));
    }
}

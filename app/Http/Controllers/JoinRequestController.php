<?php

namespace App\Http\Controllers;

use App\Models\JoinRequest;
use App\Models\Team;
use App\Models\memberships; // Pastikan nama model keanggotaan sudah benar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JoinRequestController extends Controller
{
    /**
     * Menampilkan daftar permohonan untuk tim yang dipimpin oleh user.
     */
    public function index()
    {
        $user = Auth::user();
        // Ambil semua tim dimana user adalah leader
        $ledTeams = $user->ownedTeams()->pluck('id');

        // Ambil semua permohonan yang statusnya 'pending' untuk tim-tim tersebut
        $joinRequests = JoinRequest::with('user', 'team')
            ->whereIn('team_id', $ledTeams)
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('join-requests.index', compact('joinRequests'));
    }

    /**
     * Menyimpan permohonan bergabung baru.
     */
    public function store(Request $request, Team $team)
    {
        $user = Auth::user();

        // Cek apakah user sudah menjadi anggota tim
        if ($user->belongsToTeam($team)) {
            return back()->with('error', 'Anda sudah menjadi anggota tim ini.');
        }

        // Cek apakah user sudah pernah mengirim permohonan
        $existingRequest = JoinRequest::where('user_id', $user->id)
            ->where('team_id', $team->id)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return back()->with('info', 'Anda sudah mengirim permohonan untuk bergabung dengan tim ini.');
        }

        JoinRequest::create([
            'user_id' => $user->id,
            'team_id' => $team->id,
        ]);

        return back()->with('success', 'Permohonan untuk bergabung telah dikirim.');
    }

    /**
     * Menyetujui permohonan.
     */
    public function approve(JoinRequest $joinRequest)
    {
        // Otorisasi: Hanya leader tim yang bisa menyetujui
        $this->authorize('manage', $joinRequest->team);

        // Ubah status permohonan
        $joinRequest->update(['status' => 'approved']);

        // Tambahkan user ke tabel memberships
        memberships::create([
            'user_id' => $joinRequest->user_id,
            'team_id' => $joinRequest->team_id,
        ]);

        return back()->with('success', 'Permohonan disetujui. Pengguna telah ditambahkan ke tim.');
    }

    /**
     * Menolak permohonan.
     */
    public function reject(JoinRequest $joinRequest)
    {
        // Otorisasi: Hanya leader tim yang bisa menolak
        $this->authorize('manage', $joinRequest->team);

        $joinRequest->update(['status' => 'rejected']);

        return back()->with('success', 'Permohonan telah ditolak.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\memberships;
use App\Models\teams;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    /**
     * Menampilkan semua anggota dari sebuah tim.
     * (Biasanya ini ditampilkan di halaman detail tim)
     */
    public function index(teams $team)
    {
        // Pastikan hanya leader tim yang bisa melihat halaman ini jika diperlukan
        // $this->authorize('view', $team);

        $members = $team->members;
        return view('teams.members.index', compact('team', 'members'));
    }

    /**
     * Menambahkan user baru ke dalam tim.
     * (Biasanya dipicu dari form undangan atau tambah anggota)
     */
    public function store(Request $request, teams $team)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'nullable|string|max:255',
        ]);

        // Cek apakah user sudah menjadi anggota
        $isMember = $team->members()->where('user_id', $request->user_id)->exists();

        if ($isMember) {
            return back()->with('error', 'Pengguna ini sudah menjadi anggota tim.');
        }

        // Tambahkan user sebagai anggota
        memberships::create([
            'team_id' => $team->id,
            'user_id' => $request->user_id,
            'role' => $request->role ?? 'Member', // Default role
        ]);

        return back()->with('success', 'Anggota berhasil ditambahkan.');
    }


    /**
     * Menghapus anggota dari sebuah tim.
     */
    public function destroy(teams $team, User $user)
    {
        // Pastikan hanya leader yang bisa menghapus anggota
        if (Auth::id() !== $team->leader_id) {
            return back()->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }

        // Jangan biarkan leader menghapus dirinya sendiri
        if ($user->id === $team->leader_id) {
            return back()->with('error', 'Leader tidak bisa keluar dari timnya sendiri.');
        }

        // Hapus keanggotaan
        $team->members()->detach($user->id);

        return back()->with('success', 'Anggota berhasil dihapus dari tim.');
    }
}

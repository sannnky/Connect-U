<?php

namespace App\Http\controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Event; // Menggunakan model Event yang benar
use App\Models\Project; // Menggunakan model Project yang benar
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil publik pengguna.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        // 1. Ambil semua tim yang diikuti pengguna
        $teams = $user->teams()->get();
        $teamIds = $teams->pluck('id');

        // 2. Ambil semua ID kategori unik dari proyek yang terkait dengan tim tersebut
        $categoryIds = Project::whereIn('team_id', $teamIds)
            ->whereNotNull('category_id')
            ->pluck('category_id')
            ->unique();

        // 3. Ambil semua event MENDATANG yang memiliki kategori yang cocok
        $events = Event::whereIn('category_id', $categoryIds)
            ->where('start_at', '>=', now()) // <-- Filter untuk event yang belum lewat
            ->orderBy('start_at', 'asc') // <-- Urutkan dari yang paling dekat
            ->get();

        return view('profile.index', compact('user', 'teams', 'events'));
    }

    /**
     * Menampilkan halaman edit profil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Memperbarui informasi profil pengguna.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();

        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            // Simpan avatar baru
            $path = $request->file('avatar')->store('avatars', 'public');
            $validatedData['avatar'] = $path;
        }

        $user->fill($validatedData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Menghapus akun pengguna.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Mengarahkan ke halaman login dengan pesan sukses
        return Redirect::route('login')->with('status', 'Akun Anda telah berhasil dihapus.');
    }
}

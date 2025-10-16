<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * Otorisasi umum untuk mengelola tim (misal: menyetujui anggota).
     * Hanya leader tim yang bisa.
     */
    public function manage(User $user, Team $team): bool
    {
        return $user->isLeaderOf($team);
    }
}
<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     * Diubah agar semua user bisa melihat detail project untuk fitur "Gabung Tim".
     */
    public function view(User $user, Project $project): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     * Hanya leader atau anggota tim yang bisa update.
     */
    public function update(User $user, Project $project): bool
    {
        if (!$project->team) {
            return false;
        }
        return $user->isLeaderOf($project->team) || $user->belongsToTeam($project->team);
    }

    /**
     * Determine whether the user can delete the model.
     * Hanya leader tim yang bisa menghapus.
     */
    public function delete(User $user, Project $project): bool
    {
        if (!$project->team) {
            return false;
        }
        return $user->isLeaderOf($project->team);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $project): bool
    {
        if (!$project->team) {
            return false;
        }
        return $user->isLeaderOf($project->team);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        if (!$project->team) {
            return false;
        }
        return $user->isLeaderOf($project->team);
    }
}
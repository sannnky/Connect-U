<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Nama class diubah menjadi "Team" (PascalCase, Singular)
class Team extends Model
{
    use HasFactory;

    // Nama tabel didefinisikan secara eksplisit
    protected $table = 'teams';

    protected $fillable = [
        'name',
        'description',
        'leader_id',
    ];

    /**
     * Mendapatkan pemimpin (leader) dari tim ini.
     */
    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    /**
     * Mendapatkan semua anggota tim.
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'memberships', 'team_id', 'user_id');
    }

    /**
     * Mendapatkan semua proyek yang dimiliki tim ini.
     */
    public function projects()
    {
        // Relasi diubah untuk menunjuk ke model "Project"
        return $this->hasMany(Project::class);
    }
}

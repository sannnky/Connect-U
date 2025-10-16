<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Pastikan nama class adalah "Project" (PascalCase, Singular)
class Project extends Model
{
    use HasFactory;

    /**
     * Secara eksplisit mendefinisikan nama tabel untuk menghindari kebingungan.
     * @var string
     */
    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'team_id',
        'category_id',
        'status',
    ];

    /**
     * Mendapatkan tim yang memiliki proyek ini.
     * Relasi ini harus menunjuk ke class 'Team'.
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    /**
     * Mendapatkan kategori dari proyek ini.
     * Relasi ini harus menunjuk ke class 'Category'.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Mendapatkan semua data progress untuk proyek ini.
     * Relasi ini harus menunjuk ke class 'Progress'.
     */
    public function progress()
    {
        // Pastikan Anda memiliki model 'Progress'
        return $this->hasMany(Progress::class, 'project_id');
    }
}

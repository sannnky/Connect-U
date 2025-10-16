<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Nama class diubah menjadi "Category" (PascalCase, Singular)
class Category extends Model
{
    use HasFactory;

    // Nama tabel didefinisikan secara eksplisit
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Mendapatkan semua proyek yang termasuk dalam kategori ini.
     */
    public function projects()
    {
        // Relasi diubah untuk menunjuk ke model "Project"
        return $this->hasMany(Project::class);
    }
}

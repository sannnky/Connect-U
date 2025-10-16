<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'start_at',
        'end_at',
        'type',
        'category_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    /**
     * Mendapatkan kategori dari event ini.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function users()
    {
        // Sesuaikan nama tabel pivot jika perlu
        return $this->belongsToMany(User::class, 'event_user');
    }
}

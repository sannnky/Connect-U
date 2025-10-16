<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio', // Penambahan ini aman
        'avatar', // Penambahan ini aman
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Mendapatkan URL lengkap untuk avatar pengguna.
     * (Kode asli Anda dipertahankan)
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
            return Storage::url($this->avatar);
        }

        // Sediakan URL avatar default jika tidak ada foto yang diunggah
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random&color=fff';
    }

    /**
     * Mendapatkan semua data keanggotaan (memberships) untuk pengguna.
     * (Kode asli Anda dipertahankan)
     */
    public function memberships()
    {
        return $this->hasMany(memberships::class);
    }

    /**
     * Mendapatkan semua tim yang diikuti oleh pengguna melalui tabel memberships.
     * Kunci asing didefinisikan secara eksplisit untuk mengatasi konvensi penamaan.
     * (Kode asli Anda dipertahankan)
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'memberships', 'user_id', 'team_id');
    }

    /**
     * Mendapatkan semua tim yang dimiliki (dibuat) oleh pengguna.
     * (Kode asli Anda dipertahankan)
     */
    public function ownedTeams()
    {
        return $this->hasMany(Team::class, 'leader_id');
    }

    /**
     * Mendapatkan semua event yang diikuti oleh pengguna.
     * (Kode asli Anda dipertahankan)
     */
    public function events()
    {
        // Nama tabel pivot bisa berbeda (misal: event_user)
        return $this->belongsToMany(Event::class, 'event_user');
    }
}
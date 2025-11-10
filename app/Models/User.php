<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'iduser';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /** ============================
     *        RELATIONS
     *  ============================ */

    // Relasi ke tabel pemilik (business domain)
    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }

    // Relasi pivot: user bisa punya banyak role
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole')
                    ->withPivot('status');
    }

    // Shortcut: ambil satu role utama (misalnya role pertama)
    public function role()
    {
        return $this->roles()->first();
    }

    /** ============================
     *     AUTHORIZATION HELPERS
     *  ============================ */

    // Cek apakah user punya role tertentu
    public function hasRole($roleName)
    {
        return $this->roles()->where('nama_role', $roleName)->exists();
    }
}

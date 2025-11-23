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

    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }

    public function dokter()
    {
        return $this->hasOne(Dokter::class, 'iduser', 'iduser'); // ✅ Ganti jadi iduser
    }

    public function perawat()
    {
        return $this->hasOne(Perawat::class, 'iduser', 'iduser'); // ✅ Ganti jadi iduser
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole')
                    ->withPivot('status');
    }

    public function role()
    {
        return $this->roles()->first();
    }

    public function roleUser()
    {
        return $this->hasOne(RoleUser::class, 'iduser', 'iduser');
    }

    /** ============================
     *     AUTHORIZATION HELPERS
     *  ============================ */

    public function hasRole($roleName)
    {
        return $this->roles()->where('nama_role', $roleName)->exists();
    }
}
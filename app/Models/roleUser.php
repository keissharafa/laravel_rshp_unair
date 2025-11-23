<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model // Huruf besar "R" untuk naming convention
{
    use HasFactory;

    protected $table = 'role_user';
    protected $primaryKey = 'idrole_user';
    public $timestamps = false; // Cuma 1x deklarasi
    
    protected $fillable = [
        'iduser',
        'idrole',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    /**
     * Relasi ke Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }

    /**
     * Relasi ke Temu Dokter (sebagai dokter)
     */
    public function temuDokter()
    {
        return $this->hasMany(TemuDokter::class, 'idrole_user', 'idrole_user');
    }

    /**
     * Relasi ke Dokter (jika ada table dokter)
     */
    public function dokter()
    {
        return $this->hasOne(Dokter::class, 'idrole_user', 'idrole_user');
    }

    /**
     * Relasi ke Perawat (jika ada table perawat)
     */
    public function perawat()
    {
        return $this->hasOne(Perawat::class, 'idrole_user', 'idrole_user');
    }

    /**
     * Scope untuk filter by role
     */
    public function scopeByRole($query, $idrole)
    {
        return $query->where('idrole', $idrole);
    }

    /**
     * Scope untuk filter by status aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope untuk filter by user
     */
    public function scopeByUser($query, $iduser)
    {
        return $query->where('iduser', $iduser);
    }

    /**
     * Scope untuk dokter
     */
    public function scopeDokter($query)
    {
        return $query->where('idrole', 2); // 2 = role Dokter
    }

    /**
     * Scope untuk perawat
     */
    public function scopePerawat($query)
    {
        return $query->where('idrole', 3); // 3 = role Perawat
    }

    /**
     * Scope untuk resepsionis
     */
    public function scopeResepsionis($query)
    {
        return $query->where('idrole', 4); // 4 = role Resepsionis
    }

    /**
     * Check apakah user ini dokter
     */
    public function isDokter()
    {
        return $this->idrole == 2;
    }

    /**
     * Check apakah user ini perawat
     */
    public function isPerawat()
    {
        return $this->idrole == 3;
    }

    /**
     * Check apakah user ini resepsionis
     */
    public function isResepsionis()
    {
        return $this->idrole == 4;
    }

    /**
     * Check apakah user ini pemilik
     */
    public function isPemilik()
    {
        return $this->idrole == 5;
    }

    /**
     * Get nama role
     */
    public function getNamaRoleAttribute()
    {
        return $this->role?->nama_role ?? 'Tidak ada role';
    }

    /**
     * Get nama user
     */
    public function getNamaUserAttribute()
    {
        return $this->user?->nama ?? 'Tidak diketahui';
    }
}
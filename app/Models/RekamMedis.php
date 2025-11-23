<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $timestamps = false;

    protected $fillable = [
        'idreservasi_dokter',
        'created_at',
        'anamnesa',
        'temuan_klinis',
        'diagnosa',
    ];

    // Relasi ke Temu Dokter
    public function temuDokter()
    {
        return $this->belongsTo(TemuDokter::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }

    // Relasi ke Detail Rekam Medis
    public function detailRekamMedis()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }

    // Accessor buat akses pet lewat temuDokter
    public function getPetAttribute()
    {
        return $this->temuDokter->pet ?? null;
    }

    // Accessor buat akses dokter lewat temuDokter
    public function getDokterAttribute()
    {
        return $this->temuDokter->dokter ?? null;
    }
}
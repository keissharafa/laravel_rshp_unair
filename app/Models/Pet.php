<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false; 
    
    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'warna_tanda',
        'jenis_kelamin',
        'idpemilik',
        'idras_hewan'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Relasi ke Pemilik
     */
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    /**
     * Relasi ke Ras Hewan
     */
    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    /**
     * Relasi ke Rekam Medis (lewat temu_dokter)
     */
    public function temuDokter()
    {
        return $this->hasMany(TemuDokter::class, 'idpet', 'idpet');
    }

    /**
     * Relasi ke Rekam Medis (shortcut)
     * Ambil rekam medis lewat temu_dokter
     */
    public function rekamMedis()
    {
        return $this->hasManyThrough(
            RekamMedis::class,
            TemuDokter::class,
            'idpet', // Foreign key di temu_dokter
            'idreservasi_dokter', // Foreign key di rekam_medis
            'idpet', // Local key di pet
            'idreservasi_dokter' // Local key di temu_dokter
        );
    }

    /**
     * Accessor untuk umur pet
     */
    public function getUmurAttribute()
    {
        if (!$this->tanggal_lahir) {
            return 'Tidak diketahui';
        }
        
        $lahir = \Carbon\Carbon::parse($this->tanggal_lahir);
        $sekarang = \Carbon\Carbon::now();
        
        $tahun = $lahir->diffInYears($sekarang);
        $bulan = $lahir->copy()->addYears($tahun)->diffInMonths($sekarang);
        
        if ($tahun > 0) {
            return $tahun . ' tahun ' . ($bulan > 0 ? $bulan . ' bulan' : '');
        }
        
        return $bulan . ' bulan';
    }

    /**
     * Accessor untuk jenis hewan
     */
    public function getJenisHewanAttribute()
    {
        return $this->rasHewan?->jenisHewan;
    }

    /**
     * Accessor untuk nama jenis hewan
     */
    public function getNamaJenisHewanAttribute()
    {
        return $this->rasHewan?->jenisHewan?->nama_jenis_hewan ?? 'Tidak diketahui';
    }

    /**
     * Accessor untuk nama ras
     */
    public function getNamaRasAttribute()
    {
        return $this->rasHewan?->nama_ras ?? 'Tidak diketahui';
    }

    /**
     * Scope untuk filter berdasarkan pemilik
     */
    public function scopeByPemilik($query, $idpemilik)
    {
        return $query->where('idpemilik', $idpemilik);
    }

    /**
     * Scope untuk filter berdasarkan jenis kelamin
     */
    public function scopeByJenisKelamin($query, $jenisKelamin)
    {
        return $query->where('jenis_kelamin', $jenisKelamin);
    }

    /**
     * Scope untuk filter berdasarkan jenis hewan
     */
    public function scopeByJenisHewan($query, $idjenis_hewan)
    {
        return $query->whereHas('rasHewan', function($q) use ($idjenis_hewan) {
            $q->where('idjenis_hewan', $idjenis_hewan);
        });
    }
}
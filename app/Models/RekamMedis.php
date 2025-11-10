<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $timestamps = false; // karena tabel tidak punya updated_at

    protected $fillable = [
        'anamnesa',
        'temuan_klinis',
        'diagnosa',
        'idpet',
        'dokter_pemeriksa',
        'created_at', 
    ];

    // Relasi ke Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    // Relasi ke Dokter (User)
    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_pemeriksa', 'iduser');
    }
}

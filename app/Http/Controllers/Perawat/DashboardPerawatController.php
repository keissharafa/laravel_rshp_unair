<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use App\Models\RekamMedis;
use Carbon\Carbon;

class DashboardPerawatController extends Controller
{
    public function index()
    {
        // Statistik Dashboard
        $totalPasien       = Pet::count();
        $totalPemilik      = Pemilik::count();
        $totalJenisHewan   = JenisHewan::count();
        $totalRasHewan     = RasHewan::count();

        // Data Pasien/Pet Terbaru
        $pets = Pet::with([
            'pemilik.user',
            'rasHewan.jenisHewan'
        ])
        ->orderBy('idpet', 'desc')
        ->take(10)
        ->get();

        // Rekam Medis Hari Ini -> memakai relasi Eloquent
        $rekamMedisHariIni = RekamMedis::with([
                'temuDokter.pet.pemilik.user'
            ])
            ->whereDate('created_at', today())
            ->get();

        // Data Pasien berdasarkan Jenis Hewan
        $petsByJenis = DB::table('pet')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('jenis_hewan.nama_jenis_hewan', DB::raw('count(pet.idpet) as total'))
            ->groupBy('jenis_hewan.idjenis_hewan', 'jenis_hewan.nama_jenis_hewan')
            ->get();

        return view('perawat.dashboard-perawat', compact(
            'totalPasien',
            'totalPemilik',
            'totalJenisHewan',
            'totalRasHewan',
            'pets',
            'petsByJenis',
            'rekamMedisHariIni'
        ));
    }
}

<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RekamMedis;
use App\Models\Pemeriksaan;
use Carbon\Carbon;

class DashboardDokterController extends Controller
{
    public function index()
{
    // Ambil data rekam medis dengan relasi
    $rekamMedis = RekamMedis::with(['pet', 'pet.pemilik', 'dokter'])
        ->orderBy('created_at', 'desc')
        ->get();
    
    // Statistik
    $totalPasien = Pet::count();
    $totalRekamMedis = RekamMedis::count();
    $rekamMedisHariIni = RekamMedis::whereDate('created_at', Carbon::today())->count();
    $rekamMedisMingguIni = RekamMedis::whereBetween('created_at', [
        Carbon::now()->startOfWeek(),
        Carbon::now()->endOfWeek()
    ])->count();
    
    return view('dokter.dashboard_dokter', compact(
        'rekamMedis',
        'totalPasien',
        'totalRekamMedis',
        'rekamMedisHariIni',
        'rekamMedisMingguIni'
    ));
}
}
<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\JenisHewan;
use App\Models\RasHewan;

class DashboardPerawatController extends Controller
{
    public function index()
    {
        // Statistik Dashboard
        $totalPasien = Pet::count();
        $totalPemilik = Pemilik::count();
        $totalJenisHewan = JenisHewan::count();
        $totalRasHewan = RasHewan::count();

        // Data Pasien/Pet Terbaru (10 data terakhir)
        $pets = Pet::with([
            'pemilik.user',
            'rasHewan.jenisHewan'
        ])
        ->orderBy('idpet', 'desc') //sorting berdasar id terbaru
        ->take(10)
        ->get();

        // Data Pasien by Jenis Hewan 
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
            'petsByJenis'
        ));
    }
}
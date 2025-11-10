<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;
use Illuminate\Support\Facades\Auth;

class DashboardPemilikController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        // Ambil data pemilik berdasarkan user yang login
        $pemilik = Pemilik::where('iduser', $userId)->first();
        
        // KALAU GAK ADA, KASIH PESAN ERROR AJA
        if (!$pemilik) {
            return view('pemilik.dashboard-pemilik', [
                'pemilik' => null,
                'pets' => collect([]),
                'totalPet' => 0,
                'error' => 'Anda belum terdaftar sebagai pemilik. Silakan hubungi resepsionis.'
            ]);
        }
        
        // Ambil semua pet milik pemilik ini
        $pets = Pet::where('idpemilik', $pemilik->idpemilik)
            ->with(['rasHewan.jenisHewan'])
            ->get();
        
        $totalPet = $pets->count();
        
        return view('pemilik.dashboard-pemilik', compact(
            'pemilik',
            'pets',
            'totalPet'
        ));
    }
}
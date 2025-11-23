<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardDokterController extends Controller
{
    /**
     * Dashboard Dokter
     */
    public function index()
    {
        $dokter_id = Auth::id(); // ID user yang login sebagai dokter
        
        $pasienMenunggu = TemuDokter::with(['pet.pemilik.user', 'rekamMedis'])
            ->whereDate('waktu_daftar', today())
            ->where('status', 'menunggu')
            ->orderBy('no_urut', 'asc')
            ->get();
        
        // Rekam medis yang sudah diperiksa hari ini oleh dokter ini
        $rekamMedisHariIni = RekamMedis::with('temuDokter.pet')
            ->where('dokter_pemeriksa', Auth::user()->nama)
            ->whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Statistik
        $totalPasienMenunggu = $pasienMenunggu->count();
        $totalSudahDiperiksa = $rekamMedisHariIni->count();
        
        return view('dokter.dashboard_dokter', compact(
            'pasienMenunggu', 
            'rekamMedisHariIni', 
            'totalPasienMenunggu', 
            'totalSudahDiperiksa'
        ));
    }
    
    /**
     * Form untuk dokter isi detail rekam medis
     */
    public function detailRekamMedis($idrekam_medis)
    {
        $rekamMedis = RekamMedis::with('temuDokter.pet.pemilik.user')->findOrFail($idrekam_medis);
        
        return view('dokter.detail-rekam-medis', compact('rekamMedis'));
    }
    
    /**
     * Update detail rekam medis oleh dokter
     */
    public function updateDetailRekamMedis(Request $request, $idrekam_medis)
    {
        $request->validate([
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
            'resep_tindakan' => 'nullable|string',
            'catatan_dokter' => 'nullable|string',
        ]);
        
        try {
            $rekamMedis = RekamMedis::findOrFail($idrekam_medis);
            
            $rekamMedis->update([
                'temuan_klinis' => $request->temuan_klinis,
                'diagnosa' => $request->diagnosa,
                'resep_tindakan' => $request->resep_tindakan,
                'catatan_dokter' => $request->catatan_dokter,
                'dokter_pemeriksa' => Auth::user()->nama, // Update nama dokter
            ]);
            
            // Update status temu dokter jadi 'selesai'
            if ($rekamMedis->temuDokter) {
                $rekamMedis->temuDokter->update(['status' => 'selesai']);
            }
            
            return redirect()->route('dokter.dashboard_dokter')
                ->with('success', 'Detail rekam medis berhasil disimpan!');
                
        } catch (\Exception $e) {
            Log::error('Error updating detail rekam medis: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan detail rekam medis: ' . $e->getMessage());
        }
    }
    
    /**
     * Lihat detail lengkap rekam medis (read-only)
     */
    public function lihatRekamMedis($idrekam_medis)
    {
        $rekamMedis = RekamMedis::with('temuDokter.pet.pemilik.user')->findOrFail($idrekam_medis);
        
        return view('dokter.lihat-rekam-medis', compact('rekamMedis'));
    }
}

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
    // Dashboard dokter — daftar antrian + form pemeriksaan langsung di dashboard
    public function index()
    {
        // Pasien yang masih menunggu diperiksa
        $pasienMenunggu = TemuDokter::with(['pet.pemilik.user', 'rekamMedis'])
            ->whereDate('waktu_daftar', today()) // FIX created_at → waktu_daftar
            ->where('status', 'menunggu')
            ->orderBy('no_urut', 'asc')
            ->get();

        // Rekam medis yang sudah diperiksa dokter hari ini
        $rekamMedisHariIni = RekamMedis::with('temuDokter.pet')
            ->where('dokter_pemeriksa', Auth::user()->nama)
            ->whereDate('waktu_daftar', today()) // created_at salah → FIX
            ->orderBy('idrekam_medis', 'desc')
            ->get();

        return view('dokter.dashboard_dokter', [
            'pasienMenunggu' => $pasienMenunggu,
            'rekamMedisHariIni' => $rekamMedisHariIni,
            'totalPasienMenunggu' => $pasienMenunggu->count(),
            'totalSudahDiperiksa' => $rekamMedisHariIni->count(),
        ]);
    }

    // Dokter melakukan update temuan klinis + diagnosa
    public function updateRekamMedis(Request $request, $id)
    {
        $request->validate([
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
            'resep_tindakan' => 'nullable|string',
            'catatan_dokter' => 'nullable|string',
        ]);

        try {
            $rekamMedis = RekamMedis::findOrFail($id);

            $rekamMedis->update([
                'temuan_klinis' => $request->temuan_klinis,
                'diagnosa' => $request->diagnosa,
                'resep_tindakan' => $request->resep_tindakan,
                'catatan_dokter' => $request->catatan_dokter,
                'dokter_pemeriksa' => Auth::user()->nama, // dokter yang memeriksa
            ]);

            // Update status temu_dokter → selesai
            if ($rekamMedis->temuDokter) {
                $rekamMedis->temuDokter->update(['status' => 'selesai']);
            }

            return redirect()->route('dokter.dashboard')
                ->with('success', 'Pemeriksaan berhasil disimpan!');
        } catch (\Exception $e) {
            Log::error('Error updating rekam medis (dokter): '.$e->getMessage());

            return back()->withInput()->with('error', 'Terjadi kesalahan:'.$e->getMessage());
        }
    }
}

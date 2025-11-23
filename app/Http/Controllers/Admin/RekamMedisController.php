<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\TemuDokter; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with('temuDokter') 
            ->orderBy('idrekam_medis', 'desc')
            ->get();
        
        return view('admin.rekam-medis.index', compact('rekamMedis'));
    }

    public function create()
    {
        $reservasiList = TemuDokter::with(['pet.pemilik.user']) 
            ->whereNotIn('idreservasi_dokter', function($query) {
                $query->select('idreservasi_dokter')
                    ->from('rekam_medis');
            })
            ->orderBy('no_urut', 'asc')
            ->get();
                                    
        return view('admin.rekam-medis.create', compact('reservasiList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'anamnesa' => 'required|string', 
            'temuan_klinis' => 'required|string', 
            'diagnosa' => 'required|string',
            'dokter_pemeriksa' => 'required|string',
        ]);

        try {
            $exists = RekamMedis::where('idreservasi_dokter', $request->idreservasi_dokter)->exists();
            
            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Reservasi ini sudah memiliki rekam medis!');
            }

            RekamMedis::create([
                'idreservasi_dokter' => $request->idreservasi_dokter,
                'anamnesa' => $request->anamnesa,
                'temuan_klinis' => $request->temuan_klinis,
                'diagnosa' => $request->diagnosa,
                'dokter_pemeriksa' => $request->dokter_pemeriksa,
            ]);

            return redirect()->route('admin.rekam-medis.index')
                ->with('success', 'Rekam Medis berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            Log::error('Error creating rekam medis: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan rekam medis: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $rekamMedis = RekamMedis::with('temuDokter.pet.pemilik.user')->findOrFail($id); 
        return view('admin.rekam-medis.show', compact('rekamMedis'));
    }

    public function edit($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        $reservasiList = TemuDokter::with(['pet.pemilik.user'])->get(); 
        return view('admin.rekam-medis.edit', compact('rekamMedis', 'reservasiList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'anamnesa' => 'required|string', 
            'temuan_klinis' => 'required|string', 
            'diagnosa' => 'required|string',
            'dokter_pemeriksa' => 'required|string',
        ]);

        try {
            $rekamMedis = RekamMedis::findOrFail($id);
            
            $exists = RekamMedis::where('idreservasi_dokter', $request->idreservasi_dokter)
                ->where('idrekam_medis', '!=', $id)
                ->exists();
            
            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Reservasi ini sudah memiliki rekam medis!');
            }

            $rekamMedis->update([
                'idreservasi_dokter' => $request->idreservasi_dokter,
                'anamnesa' => $request->anamnesa,
                'temuan_klinis' => $request->temuan_klinis,
                'diagnosa' => $request->diagnosa,
                'dokter_pemeriksa' => $request->dokter_pemeriksa,
            ]);

            return redirect()->route('admin.rekam-medis.index')
                ->with('success', 'Rekam Medis berhasil diperbarui!');
                
        } catch (\Exception $e) {
            Log::error('Error updating rekam medis: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui rekam medis: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $rekamMedis = RekamMedis::findOrFail($id);
            $rekamMedis->delete();

            return redirect()->route('admin.rekam-medis.index')
                ->with('success', 'Rekam Medis berhasil dihapus!');
                
        } catch (\Exception $e) {
            Log::error('Error deleting rekam medis: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Gagal menghapus rekam medis: ' . $e->getMessage());
        }
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RekamMedisController extends Controller
{
    /**
     * Display all medical records.
     */
    public function index()
    {
        $rekamMedis = RekamMedis::with([
            'temuDokter',
            'temuDokter.pet.pemilik.user'
        ])
        ->orderBy('idrekam_medis', 'desc')
        ->get();

        return view('admin.rekam-medis.index', compact('rekamMedis'));
    }

    /**
     * Show form to create new medical record.
     */
    public function create()
    {
        // Ambil semua reservasi yang BELUM punya rekam medis
        $reservasiList = TemuDokter::with(['pet.pemilik.user'])
            ->whereNotIn('idreservasi_dokter', function ($query) {
                $query->select('idreservasi_dokter')->from('rekam_medis');
            })
            ->orderBy('no_urut', 'asc')
            ->get();

        return view('admin.rekam-medis.create', compact('reservasiList'));
    }

    /**
     * Store new medical record.
     */
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
            // Cegah input ganda
            if (RekamMedis::where('idreservasi_dokter', $request->idreservasi_dokter)->exists()) {
                return back()->withInput()->with('error', 'Reservasi ini sudah memiliki rekam medis!');
            }

            RekamMedis::create($request->only([
                'idreservasi_dokter',
                'anamnesa',
                'temuan_klinis',
                'diagnosa',
                'dokter_pemeriksa'
            ]));

            return redirect()->route('admin.rekam-medis.index')
                ->with('success', 'Rekam Medis berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Error creating rekam medis: '.$e->getMessage());

            return back()->withInput()
                ->with('error', 'Gagal menambahkan rekam medis: '.$e->getMessage());
        }
    }

    /**
     * Display detail medical record.
     */
    public function show($id)
    {
        $rekamMedis = RekamMedis::with([
            'temuDokter',
            'temuDokter.pet.pemilik.user'
        ])->findOrFail($id);

        return view('admin.rekam-medis.show', compact('rekamMedis'));
    }

    /**
     * Show edit form.
     */
    public function edit($id)
    {
        $rekamMedis = RekamMedis::with([
            'temuDokter.pet.pemilik.user'
        ])->findOrFail($id);

        // Semua reservasi, karena saat edit bisa saja ingin ganti reservasi
        $reservasiList = TemuDokter::with(['pet.pemilik.user'])->get();

        return view('admin.rekam-medis.edit', compact('rekamMedis', 'reservasiList'));
    }

    /**
     * Update medical record.
     */
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

            // Cegah duplikasi dengan record lain
            $exists = RekamMedis::where('idreservasi_dokter', $request->idreservasi_dokter)
                ->where('idrekam_medis', '!=', $id)
                ->exists();

            if ($exists) {
                return back()->withInput()->with('error', 'Reservasi ini sudah memiliki rekam medis!');
            }

            $rekamMedis->update($request->only([
                'idreservasi_dokter',
                'anamnesa',
                'temuan_klinis',
                'diagnosa',
                'dokter_pemeriksa'
            ]));

            return redirect()->route('admin.rekam-medis.index')
                ->with('success', 'Rekam Medis berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error updating rekam medis: '.$e->getMessage());

            return back()->withInput()
                ->with('error', 'Gagal memperbarui rekam medis: '.$e->getMessage());
        }
    }

    /**
     * Delete record.
     */
    public function destroy($id)
    {
        try {
            $rekamMedis = RekamMedis::findOrFail($id);
            $rekamMedis->delete();

            return redirect()->route('admin.rekam-medis.index')
                ->with('success', 'Rekam Medis berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Error deleting rekam medis: '.$e->getMessage());

            return back()->with(
                'error',
                'Gagal menghapus rekam medis: '.$e->getMessage()
            );
        }
    }
}

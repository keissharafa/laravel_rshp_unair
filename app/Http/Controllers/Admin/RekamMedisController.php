<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    /**
     * Tampilkan daftar rekam medis.
     */
    public function index()
    {
        $rekamMedis = RekamMedis::with('pet')->get();
        return view('admin.rekam-medis.index', compact('rekamMedis'));
    }

    /**
     * Tampilkan form untuk membuat rekam medis baru.
     */
    public function create()
    {
        // Ambil daftar pet buat dropdown
        $pets = Pet::all();

        // Kirim ke view
        return view('admin.rekam-medis.create', compact('pets'));
    }

    /**
     * Simpan data rekam medis baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'anamnesa' => 'required|string|max:255',
            'temuan_klinis' => 'nullable|string|max:255',
            'diagnosa' => 'nullable|string|max:255',
            'dokter_pemeriksa' => 'required|string|max:255',
        ]);

        RekamMedis::create([
            'idpet' => $request->idpet,
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
            'dokter_pemeriksa' => $request->dokter_pemeriksa,
            'created_at' => now(),
        ]);

        return redirect()->route('admin.rekam-medis.index')->with('success', 'Rekam medis berhasil ditambahkan!');
    }
}

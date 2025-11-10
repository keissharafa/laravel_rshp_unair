<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan;

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewans = RasHewan::with('jenisHewan')->get();
        return view('admin.ras-hewan.index', compact('rasHewans'));
    }

    public function create()
    {
        //  Ambil semua jenis hewan untuk dropdown
        $jenisHewans = JenisHewan::all();
        return view('admin.ras-hewan.create', compact('jenisHewans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ras' => 'required|string|max:100',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        RasHewan::create([
            'nama_ras' => $request->nama_ras,
            'idjenis_hewan' => $request->idjenis_hewan,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.ras-hewan.index')->with('success', 'Data Ras Hewan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $rasHewan = RasHewan::findOrFail($id);
        $jenisHewans = JenisHewan::all();

        return view('admin.ras-hewan.edit', compact('rasHewan', 'jenisHewans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ras' => 'required|string|max:100',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $rasHewan = RasHewan::findOrFail($id);
        $rasHewan->update([
            'nama_ras' => $request->nama_ras,
            'idjenis_hewan' => $request->idjenis_hewan,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.ras-hewan.index')->with('success', 'Data Ras Hewan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $rasHewan = RasHewan::findOrFail($id);
        $rasHewan->delete();

        return redirect()->route('admin.ras-hewan.index')->with('success', 'Data Ras Hewan berhasil dihapus.');
    }
}

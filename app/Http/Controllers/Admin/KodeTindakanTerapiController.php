<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;

class KodeTindakanTerapiController extends Controller
{
    public function index()
    {
        // Eager loading relasi untuk tampilan index yang lebih efisien
        $kodeTindakanTerapis = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        return view('admin.kode-tindakan-terapi.index', compact('kodeTindakanTerapis'));
    }

    public function create()
    {
        // Ambil semua data Kategori dan KategoriKlinis untuk dropdown
        $kategoris = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        
        return view('admin.kode-tindakan-terapi.create', compact('kategoris', 'kategoriKlinis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_tindakan' => 'required|string|max:50|unique:kode_tindakan_terapis,kode_tindakan',
            'deskripsi_tindakan_terapi' => 'required|string|min:3|max:255',
            'kategori_id' => 'required|exists:kategoris,id', 
            'kategori_klinis_id' => 'required|exists:kategori_klinis,id',
            'keterangan' => 'nullable|string', 
        ]);

        KodeTindakanTerapi::create([
            'kode_tindakan' => $request->kode_tindakan,
            'deskripsi_tindakan_terapi' => $request->deskripsi_tindakan_terapi,
            'kategori_id' => $request->kategori_id,
            'kategori_klinis_id' => $request->kategori_klinis_id,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.kode-tindakan-terapi.index')
            ->with('success', 'Kode tindakan terapi berhasil ditambahkan!');
    }

    public function show($id)
    {
        $kodeTindakan = KodeTindakanTerapi::findOrFail($id);
        return view('admin.kode-tindakan-terapi.show', compact('kodeTindakan'));
    }

    public function edit($id)
    {
        $kodeTindakan = KodeTindakanTerapi::findOrFail($id);
        $kategoris = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        
        return view('admin.kode-tindakan-terapi.edit', compact('kodeTindakan', 'kategoris', 'kategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_tindakan' => 'required|string|max:50|unique:kode_tindakan_terapis,kode_tindakan,' . $id,
            'deskripsi_tindakan_terapi' => 'required|string|min:3|max:255',
            'kategori_id' => 'required|exists:kategoris,id', 
            'kategori_klinis_id' => 'required|exists:kategori_klinis,id',
            'keterangan' => 'nullable|string', 
        ]);

        $kodeTindakan = KodeTindakanTerapi::findOrFail($id);
        $kodeTindakan->update([
            'kode_tindakan' => $request->kode_tindakan,
            'deskripsi_tindakan_terapi' => $request->deskripsi_tindakan_terapi,
            'kategori_id' => $request->kategori_id,
            'kategori_klinis_id' => $request->kategori_klinis_id,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.kode-tindakan-terapi.index')
            ->with('success', 'Kode tindakan terapi berhasil diupdate!');
    }

    public function destroy($id)
    {
        $kodeTindakan = KodeTindakanTerapi::findOrFail($id);
        $kodeTindakan->delete();

        return redirect()->route('admin.kode-tindakan-terapi.index')
            ->with('success', 'Kode tindakan terapi berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Models\KategoriKlinis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $kategoriKlinis = KategoriKlinis::orderBy('idkategori_klinis', 'desc')->get();
        return view('admin.kategori-klinis.index', compact('kategoriKlinis'));
    }
    
    public function create()
    {
        return view('admin.kategori-klinis.create');
    }
    
    public function store(Request $request)
    {
        $validatedData = $this->validateKategoriKlinis($request);
        
        try {
            KategoriKlinis::create([
                'nama_kategori_klinis' => $this->formatNama($validatedData['nama_kategori_klinis']),
                'keterangan' => $validatedData['keterangan'] ?? null,
            ]);

            return redirect()->route('admin.kategori-klinis.index')
                            ->with('success', 'Kategori klinis berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan kategori klinis: ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function show($id)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        return view('admin.kategori-klinis.show', compact('kategoriKlinis'));
    }

    public function edit($id)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        return view('admin.kategori-klinis.edit', compact('kategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateKategoriKlinis($request, $id);
        
        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        $kategoriKlinis->update([
            'nama_kategori_klinis' => $this->formatNama($validatedData['nama_kategori_klinis']),
            'keterangan' => $validatedData['keterangan'] ?? null,
        ]);

        return redirect()->route('admin.kategori-klinis.index')
                        ->with('success', 'Kategori klinis berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        $kategoriKlinis->delete();

        return redirect()->route('admin.kategori-klinis.index')
                        ->with('success', 'Kategori klinis berhasil dihapus.');
    }

    // === HELPER METHODS ===

    protected function validateKategoriKlinis(Request $request, $id = null)
    {
        $uniqueRule = $id ? 
            'unique:kategori_klinis,nama_kategori_klinis,' . $id . ',idkategori_klinis' : 
            'unique:kategori_klinis,nama_kategori_klinis';

        return $request->validate([
            'nama_kategori_klinis' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule
            ],
            'keterangan' => [
                'nullable',
                'string',
                'max:500'
            ],
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi.',
            'nama_kategori_klinis.string' => 'Nama kategori klinis harus berupa teks.',
            'nama_kategori_klinis.max' => 'Nama kategori klinis maksimal 255 karakter.',
            'nama_kategori_klinis.min' => 'Nama kategori klinis minimal 3 karakter.',
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah ada.',
            'keterangan.max' => 'Keterangan maksimal 500 karakter.',
        ]);
    }

    protected function formatNama($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
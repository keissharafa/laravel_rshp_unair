<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::orderBy('idkategori', 'desc')->get();
        return view('admin.kategori.index', compact('kategoris'));
    }
    
    public function create()
    {
        return view('admin.kategori.create');
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateKategori($request);

        // Helper untuk menyimpan data
        $kategori = $this->createKategori($validatedData);

        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.show', compact('kategori'));
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateKategori($request, $id);
        
        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $this->formatNamaKategori($validatedData['nama_kategori']),
            'deskripsi' => $validatedData['deskripsi'] ?? null,
        ]);

        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')
                        ->with('success', 'Kategori berhasil dihapus.');
    }

    // === HELPER METHODS ===

    protected function validateKategori(Request $request, $id = null)
    {
        // data yang bersifat unique
        $uniqueRule = $id ? 
            'unique:kategori,nama_kategori,' . $id . ',idkategori' : 
            'unique:kategori,nama_kategori';

        // validasi data input
        return $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule
            ],
            'deskripsi' => [
                'nullable',
                'string',
                'max:500'
            ],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.string' => 'Nama kategori harus berupa teks.',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter.',
            'nama_kategori.min' => 'Nama kategori minimal 3 karakter.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter.',
        ]);
    }

    protected function createKategori(array $data)
    {
        try {
            return Kategori::create([
                'nama_kategori' => $this->formatNamaKategori($data['nama_kategori']),
                'deskripsi' => $data['deskripsi'] ?? null,
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data kategori: ' . $e->getMessage());
        }
    }

    protected function formatNamaKategori($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
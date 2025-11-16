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
        $kodeTindakanTerapis = KodeTindakanTerapi::all();
        return view('admin.kode-tindakan-terapi.index', compact('kodeTindakanTerapis'));
    }

    public function create()
    {
        return view('admin.kode-tindakan-terapi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_tindakan' => 'required|string|max:50',
            'nama_tindakan' => 'required|string|max:255',
        ]);

        KodeTindakanTerapi::create($request->all());

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
            'kode_tindakan' => 'required|string|max:50',
            'nama_tindakan' => 'required|string|max:255',
        ]);

        $kodeTindakan = KodeTindakanTerapi::findOrFail($id);
        $kodeTindakan->update($request->all());

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
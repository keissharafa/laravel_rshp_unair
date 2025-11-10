<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;
use App\Models\JenisHewan;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with(['pemilik', 'rasHewan.jenisHewan'])->get();
        return view('admin.pet.index', compact('pets'));
    }

    public function create()
    {
        $pemiliks = Pemilik::all();
        $jenisHewans = JenisHewan::all();
        $rasHewans = RasHewan::with('jenisHewan')->get();
        
        return view('admin.pet.create', compact('pemiliks', 'jenisHewans', 'rasHewans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pet' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'warna' => 'required|string|max:100',
            'ciri_khas' => 'nullable|string',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ]);

        try {
            Pet::create([
                'nama_pet' => $request->nama_pet,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'warna' => $request->warna,
                'ciri_khas' => $request->ciri_khas,
                'idpemilik' => $request->idpemilik,
                'idras_hewan' => $request->idras_hewan,
            ]);

            return redirect()->route('admin.pet.index')
                ->with('success', 'Pet berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            \Log::error('Error creating pet: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan pet: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $pet = Pet::with(['pemilik', 'rasHewan.jenisHewan', 'rekamMedis'])->findOrFail($id);
        return view('admin.pet.show', compact('pet'));
    }

    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        $pemiliks = Pemilik::all();
        $jenisHewans = JenisHewan::all();
        $rasHewans = RasHewan::with('jenisHewan')->get();
        
        return view('admin.pet.edit', compact('pet', 'pemiliks', 'jenisHewans', 'rasHewans'));
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);
        
        $request->validate([
            'nama_pet' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'warna' => 'required|string|max:100',
            'ciri_khas' => 'nullable|string',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ]);

        try {
            $pet->update([
                'nama_pet' => $request->nama_pet,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'warna' => $request->warna,
                'ciri_khas' => $request->ciri_khas,
                'idpemilik' => $request->idpemilik,
                'idras_hewan' => $request->idras_hewan,
            ]);

            return redirect()->route('admin.pet.index')
                ->with('success', 'Pet berhasil diupdate!');
                
        } catch (\Exception $e) {
            \Log::error('Error updating pet: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate pet: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $pet = Pet::findOrFail($id);
            $pet->delete();
            
            return redirect()->route('admin.pet.index')
                ->with('success', 'Pet berhasil dihapus!');
                
        } catch (\Exception $e) {
            \Log::error('Error deleting pet: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Gagal menghapus pet: ' . $e->getMessage());
        }
    }
}
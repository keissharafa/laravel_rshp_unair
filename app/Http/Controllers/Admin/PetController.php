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
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'jenis_kelamin' => 'required|in:J,B', // J=Jantan, B=Betina (sesuai char(1))
            'warna_tanda' => 'required|string|max:45',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ]);

        try {
            Pet::create([
                'nama' => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'warna_tanda' => $request->warna_tanda,
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
        $pet = Pet::with([
            'pemilik',
            'rasHewan.jenisHewan',
            'temuDokter.rekamMedis' // Update: lewat temu_dokter dulu
        ])->findOrFail($id);
        
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
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'jenis_kelamin' => 'required|in:J,B',
            'warna_tanda' => 'required|string|max:45',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ]);

        try {
            $pet->update([
                'nama' => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'warna_tanda' => $request->warna_tanda,
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
            
            // Cek apakah pet punya rekam medis
            if ($pet->temuDokter()->exists()) {
                return redirect()->back()
                    ->with('error', 'Tidak dapat menghapus pet yang sudah memiliki rekam medis!');
            }
            
            $pet->delete();
            
            return redirect()->route('admin.pet.index')
                ->with('success', 'Pet berhasil dihapus!');
                
        } catch (\Exception $e) {
            \Log::error('Error deleting pet: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Gagal menghapus pet: ' . $e->getMessage());
        }
    }

    /**
     * Get ras hewan berdasarkan jenis hewan (AJAX)
     */
    public function getRasByJenis($idjenis_hewan)
    {
        $rasHewans = RasHewan::where('idjenis_hewan', $idjenis_hewan)->get();
        return response()->json($rasHewans);
    }
}
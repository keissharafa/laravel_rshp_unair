<?php

namespace App\Http\Controllers\Admin;

use App\Models\JenisHewan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisHewanController extends Controller
{
    public function index()
    {
        // eloquent
        // $jenisHewan = JenisHewan::all();

        // query builder
        $jenisHewan = DB::table('jenis_hewan')
            ->select('idjenis_hewan', 'nama_jenis_hewan')
            ->get();

        return view('admin.jenis-hewan.index', compact('jenisHewan'));
    }
    
    // create: buat manggil form create
    public function create()
    {
        return view('admin.jenis-hewan.create');
    }
    
    // store: buat nyimpen data
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateJenisHewan($request);

        // Helper untuk menyimpan data
        $jenisHewan = $this->createJenisHewan($validatedData);

        return redirect()->route('admin.jenis-hewan.index')
                        ->with('success', 'Jenis hewan berhasil ditambahkan.');
    }

    protected function validateJenisHewan(Request $request, $id = null)
    {
        // data yang bersifat unique
        $uniqueRule = $id ? 
            'unique:jenis_hewan,nama_jenis_hewan,' . $id . ',idjenis_hewan' : 
            'unique:jenis_hewan,nama_jenis_hewan';

        // validasi data input
        return $request->validate([
            'nama_jenis_hewan' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule
            ],
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi.',
            'nama_jenis_hewan.string' => 'Nama jenis hewan harus berupa teks.',
            'nama_jenis_hewan.max' => 'Nama jenis hewan maksimal 255 karakter.',
            'nama_jenis_hewan.min' => 'Nama jenis hewan minimal 3 karakter.',
            'nama_jenis_hewan.unique' => 'Nama jenis hewan sudah ada.',
        ]);
    }

    // Helper untuk membuat data baru
    protected function createJenisHewan(array $data)
    {
        try {
            // eloquent
            // return JenisHewan::create([
            //    'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            //]);

            // query builder
            DB::table('jenis_hewan')->insert([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            ]);

            return true;
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data jenis hewan: ' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaJenisHewan($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
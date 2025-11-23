<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::with('user')->get();
        return view('admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        return view('admin.dokter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'bidang_dokter' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|in:L,P'
        ]);

        DB::beginTransaction();
        try {
            // Buat user
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            // Assign role dokter
            $roleDokter = Role::where('nama_role', 'dokter')->first();
            if ($roleDokter) {
                $user->roles()->attach($roleDokter->idrole, ['status' => 'active']);
            }

            // Buat data dokter
            Dokter::create([
                'id_user' => $user->iduser,
                'bidang_dokter' => $request->bidang_dokter,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin
            ]);

            DB::commit();
            return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $dokter = Dokter::with('user')->findOrFail($id);
        return view('admin.dokter.show', compact('dokter'));
    }

    public function edit(string $id)
    {
        $dokter = Dokter::with('user')->findOrFail($id);
        return view('admin.dokter.edit', compact('dokter'));
    }

    public function update(Request $request, string $id)
    {
        $dokter = Dokter::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email,' . $dokter->id_user . ',iduser',
            'bidang_dokter' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|in:L,P'
        ]);

        DB::beginTransaction();
        try {
            // Update user
            $user = User::findOrFail($dokter->id_user);
            $user->update([
                'nama' => $request->nama,
                'email' => $request->email
            ]);

            // Update password jika diisi
            if ($request->filled('password')) {
                $user->update(['password' => Hash::make($request->password)]);
            }

            // Update dokter
            $dokter->update([
                'bidang_dokter' => $request->bidang_dokter,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin
            ]);

            DB::commit();
            return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $dokter = Dokter::findOrFail($id);
            $userId = $dokter->id_user;

            $dokter->delete();
            User::findOrFail($userId)->delete();

            DB::commit();
            return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
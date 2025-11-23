<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perawat;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PerawatController extends Controller
{
    public function index()
    {
        $perawats = Perawat::with('user')->get();
        return view('admin.perawat.index', compact('perawats'));
    }

    public function create()
    {
        return view('admin.perawat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|in:L,P',
            'pendidikan' => 'required|string|max:100'
        ]);

        DB::beginTransaction();
        try {
            // Buat user
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            // Assign role perawat
            $rolePerawat = Role::where('nama_role', 'perawat')->first();
            if ($rolePerawat) {
                $user->roles()->attach($rolePerawat->idrole, ['status' => 'active']);
            }

            // Buat data perawat
            Perawat::create([
                'id_user' => $user->iduser,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'pendidikan' => $request->pendidikan
            ]);

            DB::commit();
            return redirect()->route('admin.perawat.index')->with('success', 'Data perawat berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $perawat = Perawat::with('user')->findOrFail($id);
        return view('admin.perawat.show', compact('perawat'));
    }

    public function edit(string $id)
    {
        $perawat = Perawat::with('user')->findOrFail($id);
        return view('admin.perawat.edit', compact('perawat'));
    }

    public function update(Request $request, string $id)
    {
        $perawat = Perawat::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email,' . $perawat->id_user . ',iduser',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|in:L,P',
            'pendidikan' => 'required|string|max:100'
        ]);

        DB::beginTransaction();
        try {
            // Update user
            $user = User::findOrFail($perawat->id_user);
            $user->update([
                'nama' => $request->nama,
                'email' => $request->email
            ]);

            // Update password jika diisi
            if ($request->filled('password')) {
                $user->update(['password' => Hash::make($request->password)]);
            }

            // Update perawat
            $perawat->update([
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'pendidikan' => $request->pendidikan
            ]);

            DB::commit();
            return redirect()->route('admin.perawat.index')->with('success', 'Data perawat berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $perawat = Perawat::findOrFail($id);
            $userId = $perawat->id_user;

            $perawat->delete();
            User::findOrFail($userId)->delete();

            DB::commit();
            return redirect()->route('admin.perawat.index')->with('success', 'Data perawat berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
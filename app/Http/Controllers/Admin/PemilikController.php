<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PemilikController extends Controller
{
    public function index()
    {
        $pemiliks = Pemilik::with('user')->get();
        return view('admin.pemilik.index', compact('pemiliks'));
    }

    public function create()
{
    return view('admin.pemilik.create');
}

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:8|confirmed', // tambah confirmed untuk validasi password_confirmation
        ]);

        try {
            // Buat user dulu
            $user = User::create([
                'name' => $request->nama_pemilik,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Buat pemilik
            Pemilik::create([
                'iduser' => $user->iduser,
                'nama_pemilik' => $request->nama_pemilik,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);

            // Assign role Pemilik
            $rolePemilik = \App\Models\Role::where('nama_role', 'Pemilik')->first();
            
            if ($rolePemilik) {
                $user->roles()->attach($rolePemilik->idrole);
            }

            return redirect()->route('admin.pemilik.index')
                ->with('success', 'Pemilik berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            // Jika terjadi error, rollback dan tampilkan pesan error
            \Log::error('Error creating pemilik: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan pemilik: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $pemilik = Pemilik::with(['user', 'pets'])->findOrFail($id);
        return view('admin.pemilik.show', compact('pemilik'));
    }

    public function edit($id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);
        return view('admin.pemilik.edit', compact('pemilik'));
    }

    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);
        
        $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:user,email,' . $pemilik->iduser . ',iduser',
            'password' => 'nullable|string|min:8|confirmed', // password optional saat update
        ]);

        try {
            // Update pemilik
            $pemilik->update([
                'nama_pemilik' => $request->nama_pemilik,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);

            // Update user
            $pemilik->user->update([
                'name' => $request->nama_pemilik,
                'email' => $request->email,
            ]);

            // Update password jika diisi
            if ($request->filled('password')) {
                $pemilik->user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            return redirect()->route('admin.pemilik.index')
                ->with('success', 'Pemilik berhasil diupdate!');
                
        } catch (\Exception $e) {
            \Log::error('Error updating pemilik: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate pemilik: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $pemilik = Pemilik::findOrFail($id);
            
            // Simpan user untuk dihapus
            $user = $pemilik->user;
            
            // Hapus pemilik dulu
            $pemilik->delete();
            
            // Kemudian hapus user
            if ($user) {
                $user->delete();
            }
            
            return redirect()->route('admin.pemilik.index')
                ->with('success', 'Pemilik berhasil dihapus!');
                
        } catch (\Exception $e) {
            \Log::error('Error deleting pemilik: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Gagal menghapus pemilik: ' . $e->getMessage());
        }
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleUserController extends Controller
{
    /**
     * Tampilkan semua role user
     */
    public function index()
    {
        $roleUsers = RoleUser::with(['role', 'user'])
            ->orderBy('idrole_user', 'desc')
            ->get();
        
        return view('admin.role-user.index', compact('roleUsers'));
    }

    /**
     * Form tambah role user
     */
    public function create()
    {
        $roles = Role::all();
        
        // Ambil user yang belum punya role atau yang mau ditambah role lagi
        $users = User::all();
        
        return view('admin.role-user.create', compact('roles', 'users'));
    }

    /**
     * Simpan role user baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'idrole' => 'required|exists:role,idrole',
            'status' => 'nullable|boolean',
        ]);

        try {
            // Cek apakah user sudah punya role ini
            $exists = RoleUser::where('iduser', $request->iduser)
                ->where('idrole', $request->idrole)
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'User sudah memiliki role ini!');
            }

            RoleUser::create([
                'iduser' => $request->iduser,
                'idrole' => $request->idrole,
                'status' => $request->status ?? 1
            ]);

            return redirect()->route('admin.role-user.index')
                ->with('success', 'Role user berhasil ditambahkan');
                
        } catch (\Exception $e) {
            Log::error('Error creating role user: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan role user: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan detail role user
     */
    public function show($id)
    {
        $roleUser = RoleUser::with(['role', 'user'])->findOrFail($id);
        return view('admin.role-user.show', compact('roleUser'));
    }

    /**
     * Form edit role user
     */
    public function edit($id)
    {
        $roleUser = RoleUser::findOrFail($id);
        $roles = Role::all();
        $users = User::all();
        
        return view('admin.role-user.edit', compact('roleUser', 'roles', 'users'));
    }

    /**
     * Update role user
     */
    public function update(Request $request, $id)
    {
        $roleUser = RoleUser::findOrFail($id);
        
        $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'idrole' => 'required|exists:role,idrole',
            'status' => 'nullable|boolean',
        ]);

        try {
            // Cek apakah kombinasi user-role sudah ada (selain record ini)
            $exists = RoleUser::where('iduser', $request->iduser)
                ->where('idrole', $request->idrole)
                ->where('idrole_user', '!=', $id)
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'User sudah memiliki role ini!');
            }

            $roleUser->update([
                'iduser' => $request->iduser,
                'idrole' => $request->idrole,
                'status' => $request->status ?? 1
            ]);

            return redirect()->route('admin.role-user.index')
                ->with('success', 'Role user berhasil diupdate');
                
        } catch (\Exception $e) {
            Log::error('Error updating role user: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate role user: ' . $e->getMessage());
        }
    }

    /**
     * Hapus role user
     */
    public function destroy($id)
    {
        try {
            $roleUser = RoleUser::findOrFail($id);
            
            // Cek apakah role user ini punya relasi dengan temu_dokter
            if ($roleUser->temuDokter()->exists()) {
                return redirect()->back()
                    ->with('error', 'Tidak dapat menghapus role user yang sudah memiliki data temu dokter!');
            }
            
            $roleUser->delete();

            return redirect()->route('admin.role-user.index')
                ->with('success', 'Role user berhasil dihapus');
                
        } catch (\Exception $e) {
            Log::error('Error deleting role user: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Gagal menghapus role user: ' . $e->getMessage());
        }
    }

    /**
     * Toggle status aktif/nonaktif
     */
    public function toggleStatus($id)
    {
        try {
            $roleUser = RoleUser::findOrFail($id);
            $roleUser->update([
                'status' => !$roleUser->status
            ]);

            $status = $roleUser->status ? 'diaktifkan' : 'dinonaktifkan';
            
            return redirect()->back()
                ->with('success', "Role user berhasil {$status}");
                
        } catch (\Exception $e) {
            Log::error('Error toggling status: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Gagal mengubah status');
        }
    }

    /**
     * Get users by role (AJAX)
     */
    public function getUsersByRole($idrole)
    {
        $roleUsers = RoleUser::with('user')
            ->where('idrole', $idrole)
            ->where('status', 1)
            ->get();
        
        return response()->json($roleUsers);
    }
}
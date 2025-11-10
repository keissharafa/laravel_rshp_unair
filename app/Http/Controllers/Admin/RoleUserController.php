<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    // Tampilkan semua role user
    public function index()
    {
        $roleUsers = RoleUser::with(['role', 'user'])->get();
        return view('role_user.index', compact('roleUsers'));
    }

    // Form tambah role user
    public function create()
    {
        $roles = Role::all();
        $users = User::all();
        return view('role_user.create', compact('roles', 'users'));
    }

    // Simpan role user baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,iduser',
            'role_id' => 'required|exists:roles,idrole',
        ]);

        RoleUser::create([
            'iduser' => $request->user_id,
            'idrole' => $request->role_id,
            'status' => 1
        ]);

        return redirect()->route('roleuser.index')->with('success', 'Role user berhasil ditambahkan');
    }

    // Form edit role user
    public function edit($id)
    {
        $roleUser = RoleUser::findOrFail($id);
        $roles = Role::all();
        $users = User::all();
        return view('role_user.edit', compact('roleUser', 'roles', 'users'));
    }

    // Update role user
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,iduser',
            'role_id' => 'required|exists:roles,idrole',
        ]);

        $roleUser = RoleUser::findOrFail($id);
        $roleUser->update([
            'iduser' => $request->user_id,
            'idrole' => $request->role_id,
            'status' => $request->status ?? 1
        ]);

        return redirect()->route('roleuser.index')->with('success', 'Role user berhasil diupdate');
    }

    // Hapus role user
    public function destroy($id)
    {
        $roleUser = RoleUser::findOrFail($id);
        $roleUser->delete();

        return redirect()->route('roleuser.index')->with('success', 'Role user berhasil dihapus');
    }
}
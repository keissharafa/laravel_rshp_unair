<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan daftar user
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Form tambah user
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Simpan user baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:191',
            'email'    => 'required|email|max:191|unique:user,email',
            'password' => 'required|min:6|confirmed',
            'idrole'   => 'required|exists:role,idrole',
        ]);

        $user = User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Simpan role ke pivot role_user
        $user->roles()->attach($request->idrole, ['status' => 1]);

        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Form edit user
     */
public function edit($id)
{
    $user = User::with('roles')->findOrFail($id);
    $roles = \App\Models\Role::all();
    return view('admin.user.edit', compact('user', 'roles'));
}


    /**
     * Update user
     */
    public function update(Request $request, $iduser)
    {
        $request->validate([
            'nama'     => 'required|string|max:191',
            'email'    => "required|email|max:191|unique:user,email,$iduser,iduser",
            'password' => 'nullable|min:6|confirmed',
            'idrole'   => 'required|exists:role,idrole',
        ]);

        $user = User::findOrFail($iduser);

        $user->nama = $request->nama;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update role pivot
        $user->roles()->sync([$request->idrole => ['status' => 1]]);

        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Hapus user
     */
    public function destroy($iduser)
    {
        $user = User::findOrFail($iduser);
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil dihapus!');
    }
}

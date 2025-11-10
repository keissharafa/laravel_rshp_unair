<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => 'required|string|max:100|unique:role,nama_role',
        ]);

        Role::create([
            'nama_role' => $request->nama_role,
        ]);

        return redirect()->route('admin.role.index')->with('success', 'Role berhasil ditambahkan!');
    }
}

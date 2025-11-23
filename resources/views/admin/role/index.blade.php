@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Daftar Role</h1>

    <a href="{{ route('admin.role.create') }}" class="btn btn-primary mb-3">+ Tambah Role</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Role</th>
                <th>Nama Role</th>
                <th style="width: 200px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($roles as $role)
                <tr>
                    <td>{{ $role->idrole }}</td>
                    <td>{{ $role->nama_role }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.role.edit', $role->idrole) }}" 
                           class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        
                        <button type="button" 
                                class="btn btn-sm btn-danger" 
                                onclick="if(confirm('Yakin ingin menghapus role ini?')) { document.getElementById('delete-form-{{ $role->idrole }}').submit(); }">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                        
                        <form id="delete-form-{{ $role->idrole }}" 
                              action="{{ route('admin.role.destroy', $role->idrole) }}" 
                              method="POST" 
                              style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada data role</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
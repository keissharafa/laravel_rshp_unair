@extends('layouts.app')

@section('title', 'Data User')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data User</h3>
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah User
        </a>
    </div>

    {{-- Pesan sukses atau error --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tabel Data User --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>ID User</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th style="width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $user->iduser ?? $user->id }}</td>
                        <td>{{ $user->nama ?? $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">
                            @if ($user->roles && $user->roles->count() > 0)
                                @foreach ($user->roles as $role)
                                    <span class="badge bg-secondary">{{ $role->nama_role }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.user.edit', $user->iduser ?? $user->id) }}" 
                               class="btn btn-sm btn-warning" 
                               title="Edit">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            
                            <button type="button" 
                                    class="btn btn-sm btn-danger" 
                                    onclick="if(confirm('Yakin ingin menghapus user ini?')) { document.getElementById('delete-form-{{ $user->iduser ?? $user->id }}').submit(); }"
                                    title="Hapus">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                            
                            <form id="delete-form-{{ $user->iduser ?? $user->id }}" 
                                  action="{{ route('admin.user.destroy', $user->iduser ?? $user->id) }}" 
                                  method="POST" 
                                  style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection


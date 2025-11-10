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
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tabel Data User --}}
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light text-center">
            <tr>
                <th>No</th>
                <th>ID User</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $index => $user)
                <tr class="text-center">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->iduser ?? $user->id }}</td>
                    <td>{{ $user->nama ?? $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->roles && $user->roles->count() > 0)
                            @foreach ($user->roles as $role)
                                <span class="badge bg-secondary">{{ $role->nama_role }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada data user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

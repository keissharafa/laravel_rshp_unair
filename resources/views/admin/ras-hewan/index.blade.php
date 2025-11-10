@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Ras Hewan</h5>
            <a href="{{ route('admin.ras-hewan.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Tambah Ras
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 5%">No</th>
                        <th>Nama Ras</th>
                        <th>Jenis Hewan</th>
                        <th style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rasHewans as $index => $ras)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $ras->nama_ras }}</td>
                            <td>{{ $ras->jenisHewan->nama_jenis ?? '-' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('admin.ras-hewan.edit', $ras->idras_hewan) }}" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form id="delete-form-{{ $ras->idras_hewan }}"
                                          action="{{ route('admin.ras-hewan.destroy', $ras->idras_hewan) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus ras ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data ras hewan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .btn-warning i, .btn-danger i {
        vertical-align: middle;
    }

    .table th, .table td {
        vertical-align: middle !important;
    }
</style>
@endsection

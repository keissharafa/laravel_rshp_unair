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
                        <th style="width: 200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rasHewans as $index => $ras)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $ras->nama_ras }}</td>
                            <td class="text-center">
                                @if($ras->jenisHewan)
                                    {{ $ras->jenisHewan->nama_jenis_hewan }}
                                @else
                                    <span class="text-danger">Belum diset</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.ras-hewan.edit', $ras->idras_hewan) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <form action="{{ route('admin.ras-hewan.destroy', $ras->idras_hewan) }}"
                                      method="POST"
                                      style="display: inline;"
                                      onsubmit="return confirm('Yakin ingin menghapus ras ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
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
    .btn i {
        vertical-align: middle;
    }

    .table th, .table td {
        vertical-align: middle !important;
    }
</style>
@endsection
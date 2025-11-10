@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0"><i class="bi bi-list-ul"></i> Data Jenis Hewan</h4>
                </div>

                <div class="card-body">
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

                    <!-- Tombol Tambah Jenis Hewan -->
                    <div class="mb-3">
                        <a href="{{ route('admin.jenis-hewan.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Jenis Hewan
                        </a>
                    </div>

                    <!-- Tabel Data Jenis Hewan -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-secondary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Jenis Hewan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jenisHewan as $index => $hewan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $hewan->nama_jenis_hewan }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" onclick="window.location='{{ route('admin.jenis-hewan.edit', $hewan->idjenis_hewan) }}'">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        
                                        <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $hewan->idjenis_hewan }}').submit(); }">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                        
                                        <form id="delete-form-{{ $hewan->idjenis_hewan }}" action="{{ route('admin.jenis-hewan.destroy', $hewan->idjenis_hewan) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        <i class="bi bi-inbox"></i> Belum ada data jenis hewan
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

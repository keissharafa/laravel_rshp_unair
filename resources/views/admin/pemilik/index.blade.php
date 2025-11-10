@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0"><i class="bi bi-person-badge"></i> Data Pemilik</h4>
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

                    <!-- Tombol Tambah Pemilik -->
                    <div class="mb-3">
                        <a href="{{ route('admin.pemilik.create') }}" class="btn btn-warning">
                            <i class="bi bi-plus-circle"></i> Tambah Pemilik
                        </a>
                    </div>

                    <!-- Tabel Data Pemilik -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-warning">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pemilik</th>
                                    <th>Email</th>
                                    <th>No. Telepon</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pemiliks as $index => $p)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $p->nama_pemilik }}</td>
                                    <td>{{ $p->user->email ?? '-' }}</td>
                                    <td>{{ $p->no_telp }}</td>
                                    <td>{{ Str::limit($p->alamat, 50) }}</td>
                                    <td>
                                        <a href="{{ route('admin.pemilik.show', $p->idpemilik) }}" 
                                           class="btn btn-sm btn-info" 
                                           title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        
                                        <a href="{{ route('admin.pemilik.edit', $p->idpemilik) }}" 
                                           class="btn btn-sm btn-warning" 
                                           title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        
                                        <button type="button" 
                                                class="btn btn-sm btn-danger" 
                                                onclick="if(confirm('Yakin ingin menghapus pemilik ini?\n\nData user dan semua pet yang terkait juga akan terhapus!')) { document.getElementById('delete-form-{{ $p->idpemilik }}').submit(); }"
                                                title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        
                                        <form id="delete-form-{{ $p->idpemilik }}" 
                                              action="{{ route('admin.pemilik.destroy', $p->idpemilik) }}" 
                                              method="POST" 
                                              style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        <i class="bi bi-inbox"></i> Belum ada data pemilik
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

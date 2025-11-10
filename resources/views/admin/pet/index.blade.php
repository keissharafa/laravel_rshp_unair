@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0"><i class="bi bi-heart-fill"></i> Data Pet</h4>
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

                    <!-- Tombol Tambah Pet -->
                    <div class="mb-3">
                        <a href="{{ route('admin.pet.create') }}" class="btn btn-danger">
                            <i class="bi bi-plus-circle"></i> Tambah Pet
                        </a>
                    </div>

                    <!-- Tabel Data Pet -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-danger">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pet</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Warna</th>
                                    <th>Ras</th>
                                    <th>Jenis Hewan</th>
                                    <th>Pemilik</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pets as $index => $pet)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $pet->nama_pet }}</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $pet->jenis_kelamin == 'Jantan' ? 'primary' : 'danger' }}">
                                            {{ $pet->jenis_kelamin }}
                                        </span>
                                    </td>
                                    <td>{{ $pet->warna }}</td>
                                    <td>{{ $pet->rasHewan->nama_ras ?? '-' }}</td>
                                    <td>{{ $pet->rasHewan->jenisHewan->nama_jenis ?? '-' }}</td>
                                    <td>{{ $pet->pemilik->nama_pemilik ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.pet.show', $pet->idpet) }}" 
                                           class="btn btn-sm btn-info" 
                                           title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        
                                        <a href="{{ route('admin.pet.edit', $pet->idpet) }}" 
                                           class="btn btn-sm btn-warning" 
                                           title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        
                                        <button type="button" 
                                                class="btn btn-sm btn-danger" 
                                                onclick="if(confirm('Yakin ingin menghapus pet ini?')) { document.getElementById('delete-form-{{ $pet->idpet }}').submit(); }"
                                                title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        
                                        <form id="delete-form-{{ $pet->idpet }}" 
                                              action="{{ route('admin.pet.destroy', $pet->idpet) }}" 
                                              method="POST" 
                                              style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">
                                        <i class="bi bi-inbox"></i> Belum ada data pet
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
@endsection
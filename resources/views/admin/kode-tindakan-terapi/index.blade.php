@extends('layouts.app')

@section('title', 'Data Kode Tindakan Terapi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Data Kode Tindakan Terapi</h4>
                    <a href="{{ route('admin.kode-tindakan-terapi.create') }}" class="btn btn-light btn-sm">
                        Tambah Kode Tindakan
                    </a>
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

                    @if($kodeTindakanTerapis->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="10%">Kode</th>
                                        <th width="30%">Deskripsi Tindakan Terapi</th>
                                        <th width="15%">Kategori</th>
                                        <th width="15%">Kategori Klinis</th>
                                        <th width="20%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kodeTindakanTerapis as $index => $kt)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td><span class="badge bg-primary">{{ $kt->kode }}</span></td>
                                        <td>{{ $kt->deskripsi_tindakan_terapi }}</td>
                                        <td>{{ $kt->kategori->nama_kategori ?? '-' }}</td>
                                        <td>{{ $kt->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.kode-tindakan-terapi.edit', $kt->idkode_tindakan_terapi) }}" 
                                               class="btn btn-sm btn-warning me-1" 
                                               title="Edit">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.kode-tindakan-terapi.destroy', $kt->idkode_tindakan_terapi) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus kode {{ $kt->kode }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger" 
                                                        title="Hapus">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            Tidak ada data kode tindakan terapi.
                            <br>
                            <a href="{{ route('admin.kode-tindakan-terapi.create') }}" class="btn btn-primary btn-sm mt-2">
                                Tambah Kode Tindakan Baru
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
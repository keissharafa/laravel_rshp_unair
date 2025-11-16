@extends('layouts.app')

@section('title', 'Data Kategori Klinis')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Data Kategori Klinis</h4>
                    <a href="{{ route('admin.kategori-klinis.create') }}" class="btn btn-light btn-sm">
                        Tambah Kategori Klinis
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

                    @if($kategoriKlinis->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="75%">Nama Kategori Klinis</th>
                                        <th width="20%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kategoriKlinis as $index => $kk)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td><strong>{{ $kk->nama_kategori_klinis }}</strong></td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.kategori-klinis.edit', $kk->idkategori_klinis) }}" 
                                               class="btn btn-sm btn-warning me-1" 
                                               title="Edit">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.kategori-klinis.destroy', $kk->idkategori_klinis) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus kategori klinis {{ $kk->nama_kategori_klinis }}?')">
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
                            Tidak ada data kategori klinis.
                            <br>
                            <a href="{{ route('admin.kategori-klinis.create') }}" class="btn btn-primary btn-sm mt-2">
                                Tambah Kategori Klinis Baru
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
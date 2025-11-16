@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Data Kategori</h4>
                    <a href="{{ route('admin.kategori.create') }}" class="btn btn-light btn-sm">
                        Tambah Kategori
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

                    @if($kategoris->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="25%">Nama Kategori</th>
                                        <th width="50%">Deskripsi</th>
                                        <th width="20%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kategoris as $index => $kategori)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td><strong>{{ $kategori->nama_kategori }}</strong></td>
                                        <td>{{ $kategori->deskripsi ?? '-' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.kategori.edit', $kategori->idkategori) }}" 
                                               class="btn btn-sm btn-warning text-white me-1" 
                                               title="Edit">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.kategori.destroy', $kategori->idkategori) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus kategori {{ $kategori->nama_kategori }}?')">
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
                            Tidak ada data kategori.
                            <br>
                            <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary btn-sm mt-2">
                                Tambah Kategori Baru
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
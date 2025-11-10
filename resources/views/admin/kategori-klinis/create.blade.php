@extends('layouts.app')

@section('title', 'Tambah Kategori Klinis')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-folder-plus"></i> Tambah Kategori Klinis</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.kategori-klinis.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_kategori_klinis" class="form-label">
                                Nama Kategori Klinis <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama_kategori_klinis') is-invalid @enderror" 
                                   id="nama_kategori_klinis" 
                                   name="nama_kategori_klinis" 
                                   value="{{ old('nama_kategori_klinis') }}" 
                                   placeholder="Contoh: Terapi, Tindakan" 
                                   required
                                   autofocus>
                            @error('nama_kategori_klinis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">Minimal 3 karakter, maksimal 255 karakter</small>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">
                                Deskripsi <span class="text-muted">(Opsional)</span>
                            </label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="4" 
                                      placeholder="Masukkan deskripsi kategori klinis (opsional)">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
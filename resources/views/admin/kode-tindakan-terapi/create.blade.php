@extends('layouts.app')

@section('title', 'Tambah Kode Tindakan Terapi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Kode Tindakan Terapi</h4> {{-- Judul diubah agar lebih spesifik --}}
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.kode-tindakan-terapi.store') }}" method="POST">
                        @csrf

                        {{-- 1. Input Deskripsi Tindakan Terapi --}}
                        <div class="mb-3">
                            <label for="deskripsi_tindakan_terapi" class="form-label">
                                Deskripsi Tindakan Terapi <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror" 
                                id="deskripsi_tindakan_terapi" 
                                name="deskripsi_tindakan_terapi" 
                                value="{{ old('deskripsi_tindakan_terapi') }}" 
                                placeholder="Contoh: Vaksinasi Rabies, Pemeriksaan Urin" 
                                required
                                autofocus>
                            @error('deskripsi_tindakan_terapi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">Minimal 3 karakter, maksimal 255 karakter</small>
                        </div>

                        {{-- 2. DROPDOWN KATEGORI --}}
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('kategori_id') is-invalid @enderror" 
                                    id="kategori_id" 
                                    name="kategori_id" 
                                    required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                {{-- Loop data kategori yang dikirim dari Controller --}}
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- 3. DROPDOWN KATEGORI KLINIS --}}
                        <div class="mb-3">
                            <label for="kategori_klinis_id" class="form-label">
                                Kategori Klinis <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('kategori_klinis_id') is-invalid @enderror" 
                                    id="kategori_klinis_id" 
                                    name="kategori_klinis_id" 
                                    required>
                                <option value="" disabled selected>Pilih Kategori Klinis</option>
                                {{-- Loop data kategori klinis yang dikirim dari Controller --}}
                                @foreach ($kategoriKlinis as $klinis)
                                    <option value="{{ $klinis->id }}" {{ old('kategori_klinis_id') == $klinis->id ? 'selected' : '' }}>
                                        {{ $klinis->nama_kategori_klinis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_klinis_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">
                                Keterangan <span class="text-muted">(Opsional)</span>
                            </label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                        id="keterangan" 
                                        name="keterangan" 
                                        rows="2" 
                                        placeholder="Masukkan keterangan tindakan terapi (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
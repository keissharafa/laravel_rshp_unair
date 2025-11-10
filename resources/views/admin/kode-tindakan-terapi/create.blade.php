@extends('layouts.app')

@section('title', 'Tambah Kode Tindakan Terapi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Kategori Tindakan Terapi</h4>
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

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">
                                Keterangan <span class="text-muted">(Opsional)</span>
                            </label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                      id="keterangan" 
                                      name="keterangan" 
                                      rows="4" 
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
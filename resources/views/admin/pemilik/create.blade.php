@extends('layouts.app')

@section('title', 'Tambah Pemilik')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0"><i class="bi bi-person-badge"></i> Tambah Pemilik</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.pemilik.store') }}" method="POST">
                        @csrf

                        <h5 class="text-primary mb-3">Data Pemilik</h5>

                        <div class="mb-3">
                            <label for="nama_pemilik" class="form-label">
                                Nama Pemilik <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama_pemilik') is-invalid @enderror" 
                                   id="nama_pemilik" 
                                   name="nama_pemilik" 
                                   value="{{ old('nama_pemilik') }}" 
                                   placeholder="Masukkan nama lengkap pemilik" 
                                   required
                                   autofocus>
                            @error('nama_pemilik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">
                                Alamat <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                      id="alamat" 
                                      name="alamat" 
                                      rows="3" 
                                      placeholder="Masukkan alamat lengkap"
                                      required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_telp" class="form-label">
                                No. Telepon <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('no_telp') is-invalid @enderror" 
                                   id="no_telp" 
                                   name="no_telp" 
                                   value="{{ old('no_telp') }}" 
                                   placeholder="Contoh: 081234567890" 
                                   required>
                            @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">Format: 08xxxxxxxxxx</small>
                        </div>

                        <hr>

                        <h5 class="text-primary mb-3">Data Akun Login</h5>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="contoh@email.com" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">Email akan digunakan untuk login</small>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Minimal 8 karakter" 
                                   required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">Minimal 8 karakter</small>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">
                                Konfirmasi Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   placeholder="Ulangi password" 
                                   required>
                            <small class="text-muted">Masukkan password yang sama</small>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-warning">
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

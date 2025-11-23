{{-- create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-file-medical"></i> Tambah Rekam Medis
                    </h5>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>Terdapat kesalahan:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.rekam-medis.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="idreservasi_dokter" class="form-label">
                                Pilih Pasien (No. Antrian) <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('idreservasi_dokter') is-invalid @enderror" 
                                    id="idreservasi_dokter" 
                                    name="idreservasi_dokter"
                                    required>
                                <option value="">-- Pilih Pasien --</option>
                                @foreach($reservasiList as $reservasi)
                                    <option value="{{ $reservasi->idreservasi_dokter }}" 
                                        {{ old('idreservasi_dokter') == $reservasi->idreservasi_dokter ? 'selected' : '' }}>
                                        No. {{ $reservasi->no_urut }} - {{ $reservasi->pet->nama ?? '-' }} ({{ $reservasi->pet->pemilik->user->nama ?? $reservasi->pet->pemilik->nama ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('idreservasi_dokter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Pilih nomor antrian pasien yang akan diperiksa</small>
                        </div>

                        <div class="mb-3">
                            <label for="anamnesa" class="form-label">
                                Anamnesa <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('anamnesa') is-invalid @enderror" 
                                      id="anamnesa" 
                                      name="anamnesa"
                                      rows="4"
                                      placeholder="Masukkan keluhan atau gejala yang dialami hewan"
                                      required>{{ old('anamnesa') }}</textarea>
                            @error('anamnesa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="temuan_klinis" class="form-label">
                                Temuan Klinis <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('temuan_klinis') is-invalid @enderror" 
                                      id="temuan_klinis" 
                                      name="temuan_klinis"
                                      rows="4"
                                      placeholder="Masukkan hasil pemeriksaan fisik dan temuan klinis"
                                      required>{{ old('temuan_klinis') }}</textarea>
                            @error('temuan_klinis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="diagnosa" class="form-label">
                                Diagnosa <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('diagnosa') is-invalid @enderror" 
                                      id="diagnosa" 
                                      name="diagnosa"
                                      rows="4"
                                      placeholder="Masukkan diagnosa penyakit"
                                      required>{{ old('diagnosa') }}</textarea>
                            @error('diagnosa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dokter_pemeriksa" class="form-label">
                                Dokter Pemeriksa <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('dokter_pemeriksa') is-invalid @enderror" 
                                   id="dokter_pemeriksa" 
                                   name="dokter_pemeriksa"
                                   value="{{ old('dokter_pemeriksa') }}"
                                   placeholder="Masukkan nama dokter pemeriksa"
                                   required>
                            @error('dokter_pemeriksa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.rekam-medis.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label {
        font-weight: 500;
    }
    
    .btn i {
        vertical-align: middle;
    }
</style>
@endsection
@extends('layouts.app')

@section('title', 'Edit Rekam Medis')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Edit Rekam Medis
                    </h4>
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

                    <form action="{{ route('admin.rekam-medis.update', $rekamMedis->idrekam_medis) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Info Temu Dokter (Read Only) -->
                        <div class="card mb-3 bg-light">
                            <div class="card-body">
                                <h6 class="card-title text-danger">
                                    <i class="bi bi-info-circle"></i> Informasi Temu Dokter
                                </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1">
                                            <strong>No. Antrian:</strong> 
                                            {{ $rekamMedis->temuDokter->no_urut ?? '-' }}
                                        </p>
                                        <p class="mb-1">
                                            <strong>Nama Pet:</strong> 
                                            {{ $rekamMedis->temuDokter->pet->nama ?? '-' }}
                                        </p>
                                        <p class="mb-0">
                                            <strong>Pemilik:</strong> 
                                            {{ $rekamMedis->temuDokter->pet->pemilik->nama_pemilik ?? '-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1">
                                            <strong>Dokter:</strong> 
                                            {{ $rekamMedis->temuDokter->dokter->user->nama ?? '-' }}
                                        </p>
                                        <p class="mb-0">
                                            <strong>Tanggal:</strong> 
                                            {{ \Carbon\Carbon::parse($rekamMedis->temuDokter->created_at)->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="anamnesa" class="form-label">
                                Anamnesa <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('anamnesa') is-invalid @enderror" 
                                      id="anamnesa" 
                                      name="anamnesa" 
                                      rows="4"
                                      placeholder="Tuliskan riwayat keluhan dan gejala yang dialami pet..."
                                      required>{{ old('anamnesa', $rekamMedis->anamnesa) }}</textarea>
                            @error('anamnesa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Contoh: Pet mengalami demam sejak 2 hari yang lalu, nafsu makan menurun
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="temuan_klinis" class="form-label">
                                Temuan Klinis <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('temuan_klinis') is-invalid @enderror" 
                                      id="temuan_klinis" 
                                      name="temuan_klinis" 
                                      rows="4"
                                      placeholder="Tuliskan hasil pemeriksaan fisik dan klinis..."
                                      required>{{ old('temuan_klinis', $rekamMedis->temuan_klinis) }}</textarea>
                            @error('temuan_klinis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Contoh: Suhu tubuh 39.5°C, mukosa mata pucat, dehidrasi ringan
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="diagnosa" class="form-label">
                                Diagnosa <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('diagnosa') is-invalid @enderror" 
                                      id="diagnosa" 
                                      name="diagnosa" 
                                      rows="3"
                                      placeholder="Tuliskan diagnosa penyakit atau kondisi pet..."
                                      required>{{ old('diagnosa', $rekamMedis->diagnosa) }}</textarea>
                            @error('diagnosa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Contoh: Infeksi saluran pencernaan akut
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="terapi" class="form-label">
                                Terapi/Pengobatan
                            </label>
                            <textarea class="form-control @error('terapi') is-invalid @enderror" 
                                      id="terapi" 
                                      name="terapi" 
                                      rows="4"
                                      placeholder="Tuliskan rencana terapi dan pengobatan (opsional)...">{{ old('terapi', $rekamMedis->terapi) }}</textarea>
                            @error('terapi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Contoh: Antibiotik Amoxicillin 2x sehari, infus ringer laktat, vitamin
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">
                                Catatan Tambahan
                            </label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                      id="catatan" 
                                      name="catatan" 
                                      rows="3"
                                      placeholder="Catatan tambahan untuk rekam medis (opsional)...">{{ old('catatan', $rekamMedis->catatan) }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-save"></i> Update Rekam Medis
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
    
    .card-title {
        font-weight: 600;
    }
</style>
@endsection
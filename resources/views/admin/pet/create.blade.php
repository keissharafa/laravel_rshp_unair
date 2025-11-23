@extends('layouts.app')

@section('title', 'Tambah Pet')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0"><i class="bi bi-heart-fill"></i> Tambah Pet</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.pet.store') }}" method="POST">
                        @csrf

                        <h5 class="text-danger mb-3">Data Pet</h5>

                        <div class="mb-3">
                            <label for="nama_pet" class="form-label">
                                Nama Pet <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama_pet" 
                                   name="nama" 
                                   value="{{ old('nama') }}" 
                                   placeholder="Masukkan nama pet" 
                                   required
                                   autofocus>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">
                                Tanggal Lahir <span class="text-danger">*</span>
                            </label>
                            <input type="date" 
                                   class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                   id="tanggal_lahir" 
                                   name="tanggal_lahir" 
                                   value="{{ old('tanggal_lahir') }}" 
                                   required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">
                                Jenis Kelamin <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                    id="jenis_kelamin" 
                                    name="jenis_kelamin" 
                                    required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="J" {{ old('jenis_kelamin') == 'J' ? 'selected' : '' }}>Jantan</option>
                                <option value="B" {{ old('jenis_kelamin') == 'B' ? 'selected' : '' }}>Betina</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="warna" class="form-label">
                                Warna/Tanda <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('warna_tanda') is-invalid @enderror" 
                                   id="warna" 
                                   name="warna_tanda" 
                                   value="{{ old('warna_tanda') }}" 
                                   placeholder="Contoh: Hitam putih, Coklat belang" 
                                   required>
                            @error('warna_tanda')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ciri_khas" class="form-label">
                                Ciri Khas <span class="text-muted">(Opsional)</span>
                            </label>
                            <textarea class="form-control @error('ciri_khas') is-invalid @enderror" 
                                      id="ciri_khas" 
                                      name="ciri_khas" 
                                      rows="3" 
                                      placeholder="Contoh: Ada bintik di telinga kanan">{{ old('ciri_khas') }}</textarea>
                            @error('ciri_khas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">Note: Field ini tidak akan disimpan di database</small>
                        </div>

                        <hr>

                        <h5 class="text-danger mb-3">Informasi Tambahan</h5>

                        <div class="mb-3">
                            <label for="idpemilik" class="form-label">
                                Pemilik <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('idpemilik') is-invalid @enderror" 
                                    id="idpemilik" 
                                    name="idpemilik" 
                                    required>
                                <option value="">-- Pilih Pemilik --</option>
                                @foreach($pemiliks as $pemilik)
                                    <option value="{{ $pemilik->idpemilik }}" {{ old('idpemilik') == $pemilik->idpemilik ? 'selected' : '' }}>
                                        {{ $pemilik->nama_pemilik }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idpemilik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idras_hewan" class="form-label">
                                Ras Hewan <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('idras_hewan') is-invalid @enderror" 
                                    id="idras_hewan" 
                                    name="idras_hewan" 
                                    required>
                                <option value="">-- Pilih Ras Hewan --</option>
                                @foreach($rasHewans as $ras)
                                    <option value="{{ $ras->idras_hewan }}" {{ old('idras_hewan') == $ras->idras_hewan ? 'selected' : '' }}>
                                        {{ $ras->nama_ras }} ({{ $ras->jenisHewan->nama_jenis ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('idras_hewan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-danger">
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
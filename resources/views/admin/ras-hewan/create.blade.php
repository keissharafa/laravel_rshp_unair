@extends('layouts.app')

@section('title', 'Tambah Ras Hewan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0"><i class="bi bi-patch-plus"></i> Tambah Ras Hewan</h4>
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.ras-hewan.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_ras" class="form-label">Nama Ras <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="nama_ras" 
                                   id="nama_ras" 
                                   class="form-control @error('nama_ras') is-invalid @enderror"
                                   value="{{ old('nama_ras') }}" 
                                   placeholder="Contoh: Persia, Golden Retriever"
                                   required>
                            @error('nama_ras')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idjenis_hewan" class="form-label">Jenis Hewan <span class="text-danger">*</span></label>
                            <select name="idjenis_hewan" id="idjenis_hewan" 
                                    class="form-select @error('idjenis_hewan') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenis Hewan --</option>
                                @foreach($jenisHewans as $jenis)
                                    <option value="{{ $jenis->idjenis_hewan }}" 
                                            {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}>
                                        {{ $jenis->nama_jenis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idjenis_hewan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      placeholder="Ciri khas, asal, atau info tambahan">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary">
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

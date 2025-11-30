@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Edit Ras Hewan
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

                    <form action="{{ route('admin.ras-hewan.update', $rasHewan->idras_hewan) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_ras" class="form-label">
                                Nama Ras <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama_ras') is-invalid @enderror" 
                                   id="nama_ras" 
                                   name="nama_ras" 
                                   value="{{ old('nama_ras', $rasHewan->nama_ras) }}"
                                   placeholder="Contoh: Persian, Golden Retriever, dll"
                                   required
                                   autofocus>
                            @error('nama_ras')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idjenis_hewan" class="form-label">
                                Jenis Hewan <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('idjenis_hewan') is-invalid @enderror" 
                                    id="idjenis_hewan" 
                                    name="idjenis_hewan"
                                    required>
                                <option value="">-- Pilih Jenis Hewan --</option>
                                @foreach($jenisHewans as $jenis)
                                    <option value="{{ $jenis->idjenis_hewan }}" 
                                            {{ old('idjenis_hewan', $rasHewan->idjenis_hewan) == $jenis->idjenis_hewan ? 'selected' : '' }}>
                                        {{ $jenis->nama_jenis_hewan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idjenis_hewan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Update Data
                            </button>
                            <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary">
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
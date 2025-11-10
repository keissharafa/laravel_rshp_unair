@extends('layouts.app')

@section('title', 'Tambah Rekam Medis')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h4><i class="bi bi-plus-circle"></i> Tambah Rekam Medis</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.rekam-medis.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="idpet" class="form-label">Pilih Hewan</label>
                            <select name="idpet" id="idpet" class="form-select @error('idpet') is-invalid @enderror" required>
                                <option value="">-- Pilih Hewan --</option>
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->idpet }}" {{ old('idpet') == $pet->idpet ? 'selected' : '' }}>
                                        {{ $pet->nama_pet }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idpet') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="anamnesa" class="form-label">Anamnesa</label>
                            <input type="text" name="anamnesa" id="anamnesa" class="form-control @error('anamnesa') is-invalid @enderror" value="{{ old('anamnesa') }}" required>
                            @error('anamnesa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="temuan_klinis" class="form-label">Temuan Klinis</label>
                            <input type="text" name="temuan_klinis" id="temuan_klinis" class="form-control" value="{{ old('temuan_klinis') }}">
                        </div>

                        <div class="mb-3">
                            <label for="diagnosa" class="form-label">Diagnosa</label>
                            <input type="text" name="diagnosa" id="diagnosa" class="form-control" value="{{ old('diagnosa') }}">
                        </div>

                        <div class="mb-3">
                            <label for="dokter_pemeriksa" class="form-label">Dokter Pemeriksa</label>
                            <input type="text" name="dokter_pemeriksa" id="dokter_pemeriksa" class="form-control" value="{{ old('dokter_pemeriksa') }}" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.rekam-medis.index') }}" class="btn btn-secondary">
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

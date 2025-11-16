@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0"><i class="fas fa-edit"></i> Edit Kode Tindakan Terapi</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.kode-tindakan-terapi.update', $kodeTindakan->idkode_tindakan_terapi) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode</label>
                            <input type="text" 
                                   class="form-control @error('kode') is-invalid @enderror" 
                                   id="kode" 
                                   name="kode" 
                                   value="{{ old('kode', $kodeTindakan->kode) }}"
                                   required>
                            
                            @error('kode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_tindakan_terapi" class="form-label">Deskripsi Tindakan Terapi</label>
                            <textarea class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror" 
                                      id="deskripsi_tindakan_terapi" 
                                      name="deskripsi_tindakan_terapi" 
                                      rows="4" 
                                      required>{{ old('deskripsi_tindakan_terapi', $kodeTindakan->deskripsi_tindakan_terapi) }}</textarea>
                            
                            @error('deskripsi_tindakan_terapi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idkategori" class="form-label">Kategori</label>
                            <select class="form-select @error('idkategori') is-invalid @enderror" 
                                    id="idkategori" 
                                    name="idkategori" 
                                    required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->idkategori }}" 
                                            {{ old('idkategori', $kodeTindakan->idkategori) == $kategori->idkategori ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            
                            @error('idkategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idkategori_klinis" class="form-label">Kategori Klinis</label>
                            <select class="form-select @error('idkategori_klinis') is-invalid @enderror" 
                                    id="idkategori_klinis" 
                                    name="idkategori_klinis" 
                                    required>
                                <option value="">-- Pilih Kategori Klinis --</option>
                                @foreach($kategoriKlinis as $kk)
                                    <option value="{{ $kk->idkategori_klinis }}" 
                                            {{ old('idkategori_klinis', $kodeTindakan->idkategori_klinis) == $kk->idkategori_klinis ? 'selected' : '' }}>
                                        {{ $kk->nama_kategori_klinis }}
                                    </option>
                                @endforeach
                            </select>
                            
                            @error('idkategori_klinis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
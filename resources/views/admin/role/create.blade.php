@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Tambah Role Baru</h1>

    <form action="{{ route('admin.role.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_role" class="form-label">Nama Role</label>
            <input type="text" name="nama_role" id="nama_role" class="form-control" required>
            @error('nama_role')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

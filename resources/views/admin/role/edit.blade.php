@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Edit Role</h1>

    <form action="{{ route('admin.role.update', $role->idrole) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">ID Role</label>
            <input type="text" class="form-control" value="{{ $role->idrole }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Role</label>
            <input type="text" 
                   name="nama_role" 
                   class="form-control @error('nama_role') is-invalid @enderror" 
                   value="{{ old('nama_role', $role->nama_role) }}" 
                   required>
            @error('nama_role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary">
            <i class="bi bi-save"></i> Update Role
        </button>

        <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Edit User
                    </h5>
                </div>

                <div class="card-body">

                    {{-- Error Messages --}}
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

                    {{-- FORM --}}
                    <form action="{{ route('admin.user.update', $user->iduser) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- ID USER --}}
                        <div class="mb-3">
                            <label class="form-label">ID User</label>
                            <input type="text" class="form-control"
                                   value="{{ $user->iduser }}" disabled readonly>
                            <small class="text-muted">ID User tidak dapat diubah</small>
                        </div>

                        {{-- NAMA --}}
                        <div class="mb-3">
                            <label class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   name="nama"
                                   value="{{ old('nama', $user->nama) }}"
                                   placeholder="Masukkan nama lengkap"
                                   required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   placeholder="contoh@email.com"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- PASSWORD BARU --}}
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   placeholder="Kosongkan jika tidak ingin mengubah password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Kosongkan jika tidak ingin mengubah password
                            </small>
                        </div>

                        {{-- KONFIRMASI PASSWORD --}}
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password"
                                   class="form-control"
                                   name="password_confirmation"
                                   placeholder="Masukkan ulang password baru">
                        </div>

                        {{-- ROLE --}}
                        <div class="mb-3">
                            <label class="form-label">Role <span class="text-danger">*</span></label>

                            @foreach($roles as $role)
                                <div class="form-check">
                                    <input class="form-check-input @error('roles') is-invalid @enderror"
                                           type="checkbox"
                                           name="roles[]"
                                           value="{{ $role->idrole }}"
                                           id="role{{ $role->idrole }}"
                                           {{ $user->roles->contains('idrole', $role->idrole) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role{{ $role->idrole }}">
                                        {{ $role->nama_role }}
                                    </label>
                                </div>
                            @endforeach

                            @error('roles')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Update User
                            </button>

                            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
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
    .form-label { font-weight: 500; }
    .btn i { vertical-align: middle; }
</style>
@endsection

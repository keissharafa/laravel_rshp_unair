{{-- edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Edit Role User
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

                    <form action="{{ route('admin.role-user.update', $roleUser->idrole_user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="iduser" class="form-label">
                                User <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('iduser') is-invalid @enderror" 
                                    id="iduser" 
                                    name="iduser"
                                    required>
                                <option value="">-- Pilih User --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->iduser }}" 
                                        {{ (old('iduser', $roleUser->iduser) == $user->iduser) ? 'selected' : '' }}>
                                        {{ $user->nama }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('iduser')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">User saat ini: <strong>{{ $roleUser->user->nama ?? '-' }}</strong></small>
                        </div>

                        <div class="mb-3">
                            <label for="idrole" class="form-label">
                                Role <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('idrole') is-invalid @enderror" 
                                    id="idrole" 
                                    name="idrole"
                                    required>
                                <option value="">-- Pilih Role --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->idrole }}" 
                                        {{ (old('idrole', $roleUser->idrole) == $role->idrole) ? 'selected' : '' }}>
                                        {{ $role->nama_role }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idrole')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Role saat ini: <strong>{{ $roleUser->role->nama_role ?? '-' }}</strong></small>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">
                                Status <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status"
                                    required>
                                <option value="">-- Pilih Status --</option>
                                <option value="1" {{ (old('status', $roleUser->status) == '1') ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ (old('status', $roleUser->status) == '0') ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save"></i> Update
                            </button>
                            <a href="{{ route('admin.role-user.index') }}" class="btn btn-secondary">
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

    .text-muted {
        font-size: 0.875rem;
    }
</style>
@endsection
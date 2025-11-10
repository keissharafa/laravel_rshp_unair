@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Daftar Role</h1>

    <a href="{{ route('admin.role.create') }}" class="btn btn-primary mb-3">+ Tambah Role</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Role</th>
                <th>Nama Role</th>
            </tr>
        </thead>
        <tbody>
            @forelse($roles as $role)
                <tr>
                    <td>{{ $role->idrole }}</td>
                    <td>{{ $role->nama_role }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">Belum ada data role</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

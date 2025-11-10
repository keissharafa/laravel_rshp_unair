@extends('layouts.app')

@section('title', 'Data Rekam Medis')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Rekam Medis</h3>
        <a href="{{ route('admin.rekam-medis.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle"></i> Tambah Rekam Medis
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-danger text-center">
            <tr>
                <th>ID</th>
                <th>Hewan</th>
                <th>Anamnesa</th>
                <th>Temuan Klinis</th>
                <th>Diagnosa</th>
                <th>Dokter Pemeriksa</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekamMedis as $rekam)
                <tr>
                    <td>{{ $rekam->idrekam_medis }}</td>
                    <td>{{ $rekam->pet->nama_pet ?? '-' }}</td>
                    <td>{{ $rekam->anamnesa }}</td>
                    <td>{{ $rekam->temuan_klinis }}</td>
                    <td>{{ $rekam->diagnosa }}</td>
                    <td>{{ $rekam->dokter_pemeriksa }}</td>
                    <td>{{ $rekam->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data rekam medis</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

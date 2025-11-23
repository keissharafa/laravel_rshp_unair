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
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-danger text-center">
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th style="width: 100px;">No. Antrian</th>
                    <th>Anamnesa</th>
                    <th>Temuan Klinis</th>
                    <th>Diagnosa</th>
                    <th style="width: 150px;">Dokter Pemeriksa</th>
                    <th style="width: 140px;">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekamMedis as $rekam)
                    <tr>
                        <td class="text-center">{{ $rekam->idrekam_medis }}</td>
                        <td class="text-center">{{ $rekam->reservasiDokter->no_urut ?? '-' }}</td>
                        <td>{{ $rekam->anamnesa }}</td>
                        <td>{{ $rekam->temuan_klinis }}</td>
                        <td>{{ $rekam->diagnosa }}</td>
                        <td>{{ $rekam->dokter_pemeriksa }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($rekam->created_at)->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada data rekam medis</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="bi bi-heart-pulse"></i> Dashboard Perawat</h4>
                </div>

                <div class="card-body">
                    <div class="alert alert-success">
                        <h5><i class="bi bi-person-check-fill"></i> Selamat datang, {{ Auth::user()->nama }}!</h5>
                        <p class="mb-0">Anda dapat melihat data pasien (pet) dan pemilik di RSHP Unair.</p>
                    </div>

                    <hr>

                    <!-- Statistik Cards -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-3">
                            <div class="card h-100 border-primary">
                                <div class="card-body text-center">
                                    <i class="bi bi-heart-fill text-primary" style="font-size: 2.5rem;"></i>
                                    <h3 class="mt-2 mb-0">{{ $totalPasien }}</h3>
                                    <p class="text-muted mb-0">Total Pasien</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card h-100 border-success">
                                <div class="card-body text-center">
                                    <i class="bi bi-people-fill text-success" style="font-size: 2.5rem;"></i>
                                    <h3 class="mt-2 mb-0">{{ $totalPemilik }}</h3>
                                    <p class="text-muted mb-0">Total Pemilik</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card h-100 border-warning">
                                <div class="card-body text-center">
                                    <i class="bi bi-list-ul text-warning" style="font-size: 2.5rem;"></i>
                                    <h3 class="mt-2 mb-0">{{ $totalJenisHewan }}</h3>
                                    <p class="text-muted mb-0">Jenis Hewan</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card h-100 border-info">
                                <div class="card-body text-center">
                                    <i class="bi bi-tags text-info" style="font-size: 2.5rem;"></i>
                                    <h3 class="mt-2 mb-0">{{ $totalRasHewan }}</h3>
                                    <p class="text-muted mb-0">Ras Hewan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Pasien Terbaru -->
                    <h5 class="text-success mb-3">
                        <i class="bi bi-heart-fill"></i> Data Pasien Terbaru
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-success">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pet</th>
                                    <th>Jenis/Ras</th>
                                    <th>Pemilik</th>
                                    <th>Tanggal Daftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pets as $pet)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $pet->nama_pet }}</strong></td>
                                    <td>
                                        {{ $pet->rasHewan->jenisHewan->nama_jenis ?? '-' }} / 
                                        {{ $pet->rasHewan->nama_ras ?? '-' }}
                                    </td>
                                    <td>{{ $pet->pemilik->user->nama ?? '-' }}</td>
                                    <td>{{ $pet->created_at ? $pet->created_at->format('d/m/Y') : '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        <i class="bi bi-inbox"></i> Belum ada data pasien
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
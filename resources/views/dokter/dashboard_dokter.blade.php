@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-clipboard2-pulse"></i> Dashboard Dokter</h4>
                </div>

                <div class="card-body">
                    <div class="alert alert-info">
                        <h5>Selamat datang, {{ Auth::user()->nama }}!</h5>
                        <p class="mb-0">Anda dapat melihat rekam medis dan data pasien.</p>
                    </div>

                    <hr>

                    <!-- Statistik Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <div class="card text-white bg-primary">
                                <div class="card-body text-center">
                                    <i class="bi bi-heart-pulse-fill" style="font-size: 2rem;"></i>
                                    <h3 class="mt-2 mb-0">{{ $totalPasien }}</h3>
                                    <p class="mb-0">Total Pasien</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-success">
                                <div class="card-body text-center">
                                    <i class="bi bi-file-medical-fill" style="font-size: 2rem;"></i>
                                    <h3 class="mt-2 mb-0">{{ $totalRekamMedis }}</h3>
                                    <p class="mb-0">Total Rekam Medis</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-warning">
                                <div class="card-body text-center">
                                    <i class="bi bi-calendar-check" style="font-size: 2rem;"></i>
                                    <h3 class="mt-2 mb-0">{{ $rekamMedisHariIni }}</h3>
                                    <p class="mb-0">Rekam Medis Hari Ini</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-info">
                                <div class="card-body text-center">
                                    <i class="bi bi-graph-up" style="font-size: 2rem;"></i>
                                    <h3 class="mt-2 mb-0">{{ $rekamMedisMingguIni }}</h3>
                                    <p class="mb-0">Minggu Ini</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Rekam Medis Terbaru -->
                    <h5 class="text-primary mb-3"><i class="bi bi-file-medical"></i> Rekam Medis Terbaru</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pet</th>
                                    <th>Pemilik</th>
                                    <th>Keluhan</th>
                                    <th>Diagnosa</th>
                                    <th>Tindakan</th>
                                    <th>Dokter</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rekamMedis->take(10) as $rm)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rm->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <strong>{{ $rm->pet->nama_pet }}</strong><br>
                                        <small class="text-muted">{{ $rm->pet->rasHewan->nama_ras ?? '-' }}</small>
                                    </td>
                                    <td>{{ $rm->pet->pemilik->user->nama ?? '-' }}</td>
                                    <td>{{ Str::limit($rm->keluhan ?? '-', 50) }}</td>
                                    <td>{{ Str::limit($rm->diagnosa ?? '-', 50) }}</td>
                                    <td>{{ Str::limit($rm->tindakan ?? '-', 50) }}</td>
                                    <td>
                                        <small>{{ $rm->dokter->nama ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.rekam-medis.show', $rm->id) }}" 
                                           class="btn btn-sm btn-info" 
                                           title="Lihat Detail">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">
                                        <i class="bi bi-inbox"></i> Belum ada data rekam medis
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Quick Actions - HANYA VIEW -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5 class="text-primary mb-3"><i class="bi bi-lightning-fill"></i> Quick Actions</h5>
                            <div class="d-flex gap-2 flex-wrap">
                                
                                <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-primary">
                                    <i class="bi bi-list-ul"></i> Lihat Rekam Medis
                                </a>
                                
                                @if(Route::has('dokter.pasien.index'))
                                <a href="{{ route('dokter.pasien.index') }}" class="btn btn-info">
                                    <i class="bi bi-heart-fill"></i> Daftar Pasien
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if(isset($pemeriksaan) && $pemeriksaan->count() > 0)
                    <!-- Data Pemeriksaan Hari Ini -->
                    <hr class="mt-4">
                    <h5 class="text-success mb-3"><i class="bi bi-calendar2-check"></i> Jadwal Pemeriksaan Hari Ini</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="table-success">
                                <tr>
                                    <th>Waktu</th>
                                    <th>Nama Pet</th>
                                    <th>Pemilik</th>
                                    <th>Jenis Pemeriksaan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pemeriksaan->where('tanggal_pemeriksaan', \Carbon\Carbon::today())->take(5) as $p)
                                <tr>
                                    <td>{{ $p->waktu ?? '-' }}</td>
                                    <td>{{ $p->pet->nama_pet }}</td>
                                    <td>{{ $p->pet->pemilik->user->nama ?? '-' }}</td>
                                    <td>{{ $p->jenis_pemeriksaan }}</td>
                                    <td>
                                        <span class="badge bg-{{ $p->status == 'selesai' ? 'success' : 'warning' }}">
                                            {{ ucfirst($p->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.lte.main')

@section('content')

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard Dokter</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard Dokter</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
<div class="container-fluid">

    <!-- Counter Pasien -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalPasienMenunggu }}</h3>
                    <p>Pasien Menunggu Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-injured"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Pasien -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Daftar Pasien Hari Ini</h3>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No Antrian</th>
                        <th>Nama Hewan</th>
                        <th>Pemilik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($rekamMedisHariIni as $rm)
                    <tr>
                        <td>{{ $rm->temuDokter->no_urut }}</td>
                        <td>{{ $rm->temuDokter->pet->nama }}</td>
                        <td>{{ $rm->temuDokter->pet->pemilik->user->nama }}</td>

                        <td>
                            <button class="btn btn-primary btn-sm"
                                data-toggle="collapse"
                                data-target="#form{{ $rm->idrekam_medis }}">
                                Periksa
                            </button>
                        </td>
                    </tr>

                    <!-- Form Pemeriksaan -->
                    <tr class="collapse" id="form{{ $rm->idrekam_medis }}">
                        <td colspan="4">

                            <form action="{{ route('dokter.rekam-medis.update-isi', $rm->idrekam_medis) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Temuan Klinis</label>
                                    <textarea class="form-control" name="temuan_klinis" required>{{ $rm->temuan_klinis }}</textarea>
                                </div>

                                <div class="form-group mt-2">
                                    <label>Diagnosa</label>
                                    <textarea class="form-control" name="diagnosa" required>{{ $rm->diagnosa }}</textarea>
                                </div>

                                <div class="form-group mt-2">
                                    <label>Resep / Tindakan</label>
                                    <textarea class="form-control" name="resep_tindakan">{{ $rm->resep_tindakan }}</textarea>
                                </div>

                                <div class="form-group mt-2">
                                    <label>Catatan Dokter</label>
                                    <textarea class="form-control" name="catatan_dokter">{{ $rm->catatan_dokter }}</textarea>
                                </div>

                                <button class="btn btn-success mt-3">
                                    Simpan Pemeriksaan
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>
</section>

@endsection

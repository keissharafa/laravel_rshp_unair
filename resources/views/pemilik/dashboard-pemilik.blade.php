@extends('layouts.lte.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0"><i class="bi bi-house-heart"></i> Dashboard Pemilik</h4>
                </div>

                <div class="card-body">
                    <div class="alert alert-info">
                        <h5>Selamat datang, {{ Auth::user()->name }}!</h5>
                        <p class="mb-0">Anda dapat melihat data pet Anda.</p>
                    </div>

                    <hr>

                    <!-- Data Pet Milik User yang Login -->
                    <h5 class="text-primary"><i class="bi bi-heart-fill"></i> Data Pet Saya</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pet</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Warna/Tanda</th>
                                    <th>Ras</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pets as $index => $pet)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $pet->nama }}</strong></td>
                                    <td>{{ $pet->tanggal_lahir ? \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        @if($pet->jenis_kelamin == 'jantan' || $pet->jenis_kelamin == 'Jantan')
                                            <span class="badge bg-primary">Jantan</span>
                                        @elseif($pet->jenis_kelamin == 'betina' || $pet->jenis_kelamin == 'Betina')
                                            <span class="badge bg-danger">Betina</span>
                                        @else
                                            {{ $pet->jenis_kelamin ?? '-' }}
                                        @endif
                                    </td>
                                    <td>{{ $pet->warna_tanda ?? '-' }}</td>
                                    <td>{{ $pet->rasHewan->nama_ras ?? 'N/A' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Anda belum memiliki pet</td>
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
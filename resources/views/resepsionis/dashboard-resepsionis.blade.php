@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="bi bi-clipboard-check"></i> Dashboard Resepsionis</h4>
                </div>

                <div class="card-body">
                    <div class="alert alert-success">
                        <h5>Selamat datang, {{ Auth::user()->name }}!</h5>
                        <p class="mb-0">Anda dapat melihat data pet dan pemilik yang terdaftar.</p>
                    </div>

                    <hr>

                    <!-- Statistik Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <div class="card text-white bg-primary">
                                <div class="card-body text-center">
                                    <i class="bi bi-heart-fill" style="font-size: 2rem;"></i>
                                    <h3 class="mt-2 mb-0">{{ $pets->count() }}</h3>
                                    <p class="mb-0">Total Pet</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-success">
                                <div class="card-body text-center">
                                    <i class="bi bi-people-fill" style="font-size: 2rem;"></i>
                                    <h3 class="mt-2 mb-0">{{ $pemiliks->count() }}</h3>
                                    <p class="mb-0">Total Pemilik</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-warning">
                                <div class="card-body text-center">
                                    <i class="bi bi-calendar-check" style="font-size: 2rem;"></i>
                                    <h3 class="mt-2 mb-0">{{ $pets->where('created_at', '>=', \Carbon\Carbon::today())->count() }}</h3>
                                    <p class="mb-0">Pendaftaran Hari Ini</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-info">
                                <div class="card-body text-center">
                                    <i class="bi bi-list-ul" style="font-size: 2rem;"></i>
                                    <h3 class="mt-2 mb-0">{{ $pets->where('created_at', '>=', \Carbon\Carbon::now()->subDays(7))->count() }}</h3>
                                    <p class="mb-0">Minggu Ini</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Pet -->
                    <h5 class="text-primary mb-3"><i class="bi bi-heart-fill"></i> Data Pet Terdaftar</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pet</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Warna/Tanda</th>
                                    <th>Ras</th>
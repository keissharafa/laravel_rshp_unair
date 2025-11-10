@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard Administrator') }} - {{ session('user_name') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>{{ __('You are logged in as ') }} {{ session('user_role_name') }}</p>

                    <div class="mt-4">
                        <h5>Menu Administrator</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-paw"></i> Jenis Hewan
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.pemilik.index') }}" class="btn btn-success btn-block">
                                    <i class="fas fa-users"></i> Pemilik
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-info btn-block">
                                    <i class="fas fa-user"></i> User
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-warning btn-block">
                                    <i class="fas fa-dog"></i> Ras Hewan
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.rekam-medis.index') }}" class="btn btn-dark btn-block">
                                    <i class="fas fa-clipboard"></i> Rekam Medis
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-list"></i> Kategori
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-dark btn-block">
                                    <i class="fas fa-clipboard"></i> Kategori Klinis
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-medkit"></i> Kode Tindakan Terapi
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.pet.index') }}" class="btn btn-success btn-block">
                                    <i class="fas fa-cat"></i> Pet
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.role.index') }}" class="btn btn-info btn-block">
                                    <i class="fas fa-user-tag"></i> Role
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.roleuser.index') }}" class="btn btn-warning btn-block">
                                    <i class="fas fa-users-cog"></i> Role User
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
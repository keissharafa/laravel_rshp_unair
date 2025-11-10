<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\RekamMedisController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanTerapiController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Pemilik\DashboardPemilikController;
use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Dokter\DashboardDokterController;
use App\Http\Controllers\Perawat\DashboardPerawatController;

Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');
Route::get('/', [SiteController::class, 'index'])->name('site.home');

// Auth
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Public Pages
Route::get('/layanan_umum', [SiteController::class, 'layanan'])->name('layanan_umum');
Route::get('/struktur_organisasi', [SiteController::class, 'struktur_organisasi'])->name('struktur_organisasi');
Route::get('/visi_misi_dan_tujuan', [SiteController::class, 'visi_misi_dan_tujuan'])->name('visi_misi_dan_tujuan');

// --------------------
// Protected Routes
// --------------------
Route::middleware(['auth'])->group(function () {

    // ADMIN
    Route::middleware('isAdministrator')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');

        Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis-hewan.index');
        Route::get('/jenis-hewan/create', [JenisHewanController::class, 'create'])->name('jenis-hewan.create');
        Route::post('/jenis-hewan/store', [JenisHewanController::class, 'store'])->name('jenis-hewan.store');

        Route::resource('pemilik', PemilikController::class);
        Route::resource('user', UserController::class);
        Route::resource('ras-hewan', RasHewanController::class);
        Route::resource('kategori', KategoriController::class);
        
        Route::resource('kategori-klinis', KategoriKlinisController::class);
        Route::resource('kode-tindakan-terapi', KodeTindakanTerapiController::class);
        Route::resource('pet', PetController::class);
        Route::resource('role', RoleController::class);
        Route::resource('role-user', RoleUserController::class);
Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('rekam-medis.index');
Route::get('/rekam-medis/create', [RekamMedisController::class, 'create'])->name('rekam-medis.create');
Route::post('/rekam-medis', [RekamMedisController::class, 'store'])->name('rekam-medis.store');
    }); 

    // PEMILIK
    Route::middleware('isPemilik')->group(function () {
        Route::get('/pemilik/dashboard', [DashboardPemilikController::class, 'index'])->name('pemilik.dashboard');
    });

    // RESEPSIONIS
    Route::middleware('isResepsionis')->group(function () {
        Route::get('/resepsionis/dashboard', [DashboardResepsionisController::class, 'index'])->name('resepsionis.dashboard');
    });

    // DOKTER
    Route::middleware('isDokter')->group(function () {
        Route::get('/dokter/dashboard', [DashboardDokterController::class, 'index'])->name('dokter.dashboard');
        Route::get('/dokter/rekam-medis', [RekamMedisController::class, 'index'])->name('dokter.rekam-medis.index');
    });

    // PERAWAT
    Route::middleware('isPerawat')->group(function () {
        Route::get('/perawat/dashboard', [DashboardPerawatController::class, 'index'])->name('perawat.dashboard');
    });
});
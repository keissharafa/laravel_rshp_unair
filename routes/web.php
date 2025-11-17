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
use App\Http\Controllers\Admin\TemuDokterController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\PerawatController;
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
        
        // Master Data
        Route::resource('jenis-hewan', JenisHewanController::class)->except(['show']);
        Route::resource('pemilik', PemilikController::class);
        Route::resource('user', UserController::class);
        Route::resource('ras-hewan', RasHewanController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('kategori-klinis', KategoriKlinisController::class);
        Route::resource('kode-tindakan-terapi', KodeTindakanTerapiController::class);
        Route::resource('pet', PetController::class);
        Route::resource('role', RoleController::class);
        Route::resource('role-user', RoleUserController::class);
        Route::resource('temu-dokter', TemuDokterController::class);
        Route::resource('rekam-medis', RekamMedisController::class);
        Route::resource('dokter', DokterController::class);
        Route::resource('perawat', PerawatController::class);
    }); 

    // PEMILIK
    Route::middleware('isPemilik')->prefix('pemilik')->name('pemilik.')->group(function () {
        Route::get('/dashboard', [DashboardPemilikController::class, 'index'])->name('dashboard');
    });

    // RESEPSIONIS
    Route::middleware('isResepsionis')->prefix('resepsionis')->name('resepsionis.')->group(function () {
        Route::get('/dashboard', [DashboardResepsionisController::class, 'index'])->name('dashboard');
        Route::resource('temu-dokter', TemuDokterController::class);
    });

    // DOKTER
    Route::middleware('isDokter')->prefix('dokter')->name('dokter.')->group(function () {
        Route::get('/dashboard', [DashboardDokterController::class, 'index'])->name('dashboard');
        Route::resource('rekam-medis', RekamMedisController::class);
    });

    // PERAWAT
    Route::middleware('isPerawat')->prefix('perawat')->name('perawat.')->group(function () {
        Route::get('/dashboard', [DashboardPerawatController::class, 'index'])->name('dashboard');
        Route::resource('rekam-medis', RekamMedisController::class)->only(['index', 'show']);
    });
});
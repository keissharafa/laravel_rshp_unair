<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\JenisHewan;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\RasHewan;

class DashboardAdminController extends Controller
{

    public function index()
{
    $users = \DB::table('user')->get();
    $roles = \DB::table('role')->get();
    $pemiliks = \DB::table('pemilik')->get();
    $pets = \DB::table('pet')->get();
    $jenisHewans = \DB::table('jenis_hewan')->get();
    $rasHewans = \DB::table('ras_hewan')->get();
    $kategoris = \DB::table('kategori')->get();
    $kategoriKlinis = \DB::table('kategori_klinis')->get();
    $kodeTindakanTerapis = \DB::table('kode_tindakan_terapi')->get();
    
    return view('admin.dashboard-admin', compact(
        'users', 'roles', 'pemiliks', 'pets', 
        'jenisHewans', 'rasHewans', 'kategoris', 
        'kategoriKlinis', 'kodeTindakanTerapis'
    ));
}
}
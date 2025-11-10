<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function cekKoneksi()
    {
        try {
            DB::connection()->getPdo();
            return 'Koneksi database berhasil!';
        } catch (\Exception $e) {
            return 'Koneksi database gagal: ' . $e->getMessage();
        }
    }

    public function index()
    {
        return view('site.home');
    }

    public function layanan()
    {
        return view('site.layanan_umum');
    }

    public function struktur_organisasi()
    {
        return view('site.struktur_organisasi');
    }

    public function visi_misi_dan_tujuan()
    {
        return view('site.visi_misi_dan_tujuan');
    }
}

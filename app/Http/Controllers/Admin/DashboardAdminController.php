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
use App\Models\Dokter; // ✅ Tambah import
use App\Models\Perawat; // ✅ Tambah import
use Illuminate\Support\Facades\Hash; // ✅ Tambah import
use Illuminate\Support\Facades\DB; // ✅ Tambah import

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
        
        // ✅ TAMBAH INI - Data dokter & perawat untuk dashboard
        $dokters = \DB::table('dokter')->get();
        $perawats = \DB::table('perawat')->get();
        
        return view('admin.dashboard-admin', compact(
            'users', 'roles', 'pemiliks', 'pets', 
            'jenisHewans', 'rasHewans', 'kategoris', 
            'kategoriKlinis', 'kodeTindakanTerapis',
            'dokters', 'perawats' // ✅ Tambah ini
        ));
    }

    // ========================================
    //    ✅ METHOD DOKTER UNTUK TRANSAKSI (CRUD)
    // ========================================

    public function dataDokter()
    {
        $dokters = Dokter::with('user')->get();
        return view('admin.data_dokter', compact('dokters'));
    }

    public function tambahDokter()
    {
        return view('admin.tambah_dokter');
    }

    public function storeDokter(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'nama_dokter' => 'required|string|max:100',
            'spesialisasi' => 'required|string|max:100',
            'no_sip' => 'required|string|max:50',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|in:L,P'
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $roleDokter = Role::where('nama_role', 'dokter')->first();
            if ($roleDokter) {
                $user->roles()->attach($roleDokter->idrole, ['status' => 'active']);
            }

            Dokter::create([
                'id_user' => $user->iduser,
                'nama_dokter' => $request->nama_dokter,
                'spesialisasi' => $request->spesialisasi,
                'no_sip' => $request->no_sip,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin
            ]);

            DB::commit();
            return redirect()->route('admin.data.dokter')->with('success', 'Data dokter berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function editDokter($id)
    {
        $dokter = Dokter::with('user')->findOrFail($id);
        return view('admin.edit_dokter', compact('dokter'));
    }

    public function updateDokter(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email,' . $dokter->id_user . ',iduser',
            'nama_dokter' => 'required|string|max:100',
            'spesialisasi' => 'required|string|max:100',
            'no_sip' => 'required|string|max:50',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|in:L,P'
        ]);

        DB::beginTransaction();
        try {
            $user = User::findOrFail($dokter->id_user);
            $user->update([
                'nama' => $request->nama,
                'email' => $request->email
            ]);

            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            $dokter->update([
                'nama_dokter' => $request->nama_dokter,
                'spesialisasi' => $request->spesialisasi,
                'no_sip' => $request->no_sip,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin
            ]);

            DB::commit();
            return redirect()->route('admin.data.dokter')->with('success', 'Data dokter berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    public function hapusDokter($id)
    {
        DB::beginTransaction();
        try {
            $dokter = Dokter::findOrFail($id);
            $userId = $dokter->id_user;

            $dokter->delete();
            User::findOrFail($userId)->delete();

            DB::commit();
            return redirect()->route('admin.data.dokter')->with('success', 'Data dokter berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // ========================================
    //    ✅ METHOD PERAWAT UNTUK TRANSAKSI (CRUD)
    // ========================================

    public function dataPerawat()
    {
        $perawats = Perawat::with('user')->get();
        return view('admin.data_perawat', compact('perawats'));
    }

    public function tambahPerawat()
    {
        return view('admin.tambah_perawat');
    }

    public function storePerawat(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'nama_perawat' => 'required|string|max:100',
            'no_sip' => 'required|string|max:50',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|in:L,P',
            'shift' => 'required|in:Pagi,Siang,Malam'
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $rolePerawat = Role::where('nama_role', 'perawat')->first();
            if ($rolePerawat) {
                $user->roles()->attach($rolePerawat->idrole, ['status' => 'active']);
            }

            Perawat::create([
                'id_user' => $user->iduser,
                'nama_perawat' => $request->nama_perawat,
                'no_sip' => $request->no_sip,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'shift' => $request->shift
            ]);

            DB::commit();
            return redirect()->route('admin.data.perawat')->with('success', 'Data perawat berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function editPerawat($id)
    {
        $perawat = Perawat::with('user')->findOrFail($id);
        return view('admin.edit_perawat', compact('perawat'));
    }

    public function updatePerawat(Request $request, $id)
    {
        $perawat = Perawat::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email,' . $perawat->id_user . ',iduser',
            'nama_perawat' => 'required|string|max:100',
            'no_sip' => 'required|string|max:50',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|in:L,P',
            'shift' => 'required|in:Pagi,Siang,Malam'
        ]);

        DB::beginTransaction();
        try {
            $user = User::findOrFail($perawat->id_user);
            $user->update([
                'nama' => $request->nama,
                'email' => $request->email
            ]);

            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            $perawat->update([
                'nama_perawat' => $request->nama_perawat,
                'no_sip' => $request->no_sip,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'shift' => $request->shift
            ]);

            DB::commit();
            return redirect()->route('admin.data.perawat')->with('success', 'Data perawat berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    public function hapusPerawat($id)
    {
        DB::beginTransaction();
        try {
            $perawat = Perawat::findOrFail($id);
            $userId = $perawat->id_user;

            $perawat->delete();
            User::findOrFail($userId)->delete();

            DB::commit();
            return redirect()->route('admin.data.perawat')->with('success', 'Data perawat berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
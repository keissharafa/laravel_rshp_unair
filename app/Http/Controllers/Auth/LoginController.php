<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // HAPUS method redirectTo() - tidak perlu!
    
    // GUNAKAN INI UNTUK REDIRECT SETELAH LOGIN
    protected function authenticated(Request $request, $user)
    {
        \Log::info('=== LOGIN SUCCESS ===');
        \Log::info('User: ' . $user->email);
        \Log::info('Roles: ' . json_encode($user->roles()->pluck('nama_role')->toArray()));
        
        if ($user->hasRole('Administrator')) {
            return redirect()->route('admin.dashboard');
        }
        
        if ($user->hasRole('Pemilik')) {
            return redirect()->route('pemilik.dashboard');
        }

        if ($user->hasRole('Dokter')) {
            return redirect()->route('dokter.dashboard');
        }
        
        if ($user->hasRole('Perawat')) {
            return redirect()->route('perawat.dashboard');
        }
        
        if ($user->hasRole('Resepsionis')) {
            return redirect()->route('resepsionis.dashboard');
        }
        
        // Fallback jika tidak ada role yang match
        \Log::warning('No role matched, redirecting to /home');
        return redirect('/home');
    }
}
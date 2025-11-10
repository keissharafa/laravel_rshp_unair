<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        
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
        
        // Fallback untuk user tanpa role
        return view('home');
    }
}
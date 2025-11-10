<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsDokter
{
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('=== MIDDLEWARE isDokter TRIGGERED ===');
        \Log::info('Request URL: ' . $request->url());
        \Log::info('Auth check: ' . (Auth::check() ? 'TRUE' : 'FALSE'));
        
        if (!Auth::check()) {
            \Log::info('User not authenticated - Redirecting to login');
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        \Log::info('User Email: ' . $user->email);
        \Log::info('User ID: ' . $user->iduser);
        
        // Cek roles
        $roles = $user->roles()->pluck('nama_role')->toArray();
        \Log::info('User Roles: ' . json_encode($roles));
        
        // Test hasRole
        $hasPemilikRole = $user->hasRole('Dokter');
        \Log::info('hasRole(Dokter): ' . ($hasPemilikRole ? 'TRUE' : 'FALSE'));
        
        if ($hasPemilikRole) {
            \Log::info('✅ ALLOWED - User is Dokter');
            return $next($request);
        }
        
        \Log::info('❌ BLOCKED - User is NOT Dokter');
        return redirect('/home')->with('error', 'Unauthorized access.');
    }
}
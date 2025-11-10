<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isResepsionis
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('=== MIDDLEWARE isResepsionis TRIGGERED ===');
        \Log::info('Request URL: ' . $request->url());
        \Log::info('Auth check: ' . (Auth::check() ? 'TRUE' : 'FALSE'));
        
        if (!Auth::check()) {
            \Log::info('User not authenticated - Redirecting to login');
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        $user = Auth::user();
        \Log::info('User Email: ' . $user->email);
        \Log::info('User ID: ' . $user->iduser);
        
        // Cek roles
        $roles = $user->roles()->pluck('nama_role')->toArray();
        \Log::info('User Roles: ' . json_encode($roles));
        
        // Test hasRole
        $hasResepsionisRole = $user->hasRole('Resepsionis');
        \Log::info('hasRole(Resepsionis): ' . ($hasResepsionisRole ? 'TRUE' : 'FALSE'));
        
        if ($hasResepsionisRole) {
            \Log::info('✅ ALLOWED - User is Resepsionis');
            return $next($request);
        }
        
        \Log::info('❌ BLOCKED - User is NOT Resepsionis');
        return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
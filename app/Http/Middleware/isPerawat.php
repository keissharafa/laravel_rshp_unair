<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsPerawat
{
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('=== MIDDLEWARE isPerawat TRIGGERED ===');
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
        
        $hasPerawatRole = $user->hasRole('Perawat'); 
        \Log::info('hasRole(Perawat): ' . ($hasPerawatRole ? 'TRUE' : 'FALSE'));
        
        if ($hasPerawatRole) {
            \Log::info('✅ ALLOWED - User is Perawat');
            return $next($request);
        }
        
        \Log::info('❌ BLOCKED - User is NOT Perawat');
        return redirect('/home')->with('error', 'Unauthorized access.');
    }
}
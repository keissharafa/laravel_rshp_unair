<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdministrator
{
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('=== MIDDLEWARE isAdministrator TRIGGERED ===');
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
        $hasAdminRole = $user->hasRole('Administrator');
        \Log::info('hasRole(Administrator): ' . ($hasAdminRole ? 'TRUE' : 'FALSE'));
        
        if ($hasAdminRole) {
            \Log::info('✅ ALLOWED - User is Administrator');
            return $next($request);
        }
        
        \Log::info('❌ BLOCKED - User is NOT Administrator');
        return redirect('/home')->with('error', 'Unauthorized access.');
    }
}
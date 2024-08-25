<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $userRole = Auth::user()->role;
        if ($userRole == 1) {
            return redirect('superadmin/dashboard');
        }
        if ($userRole == 2) {
            return redirect('admin/dashboard');
        }
        if ($userRole == 3) {
            return $next($request);
        }
    }
}

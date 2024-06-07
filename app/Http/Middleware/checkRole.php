<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        foreach($roles as $role) {
            if (Auth::check() && Auth::user()->hasRole($role)) {
                return $next($request);
            }
        }
        abort(403, 'Halaman ini hanya bisa di akses seizin Super Admin');
    }
}

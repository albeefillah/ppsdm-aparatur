<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkAccessKapus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ((auth()->check() && auth()->user()->role->role == 'Kapus') || (auth()->check() && auth()->user()->role->role == 'Super Admin') ) {
            return $next($request);
        }
    
        abort(403, 'Alamat ini hanya bisa di akses oleh Super Admin/Kapus');
    }
}

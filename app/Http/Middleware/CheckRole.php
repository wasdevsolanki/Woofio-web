<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }

        // return redirect('/');
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin');
        } else if( Auth::user()->role == 'vendor') {
            return redirect()->route('vendor.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }
}

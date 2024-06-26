<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::user()) {
            toastr()->error('Please login first');

            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        if ($userRole == '0') {
            return $next($request);
        }

        if ($userRole == '1') {
            return redirect()->route('admin.dashboard');
        }

        if ($userRole == '2') {
            return redirect()->route('admin.dashboard');
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdminFull
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login.show')->with('error', 'Please login first.');
        }

        if (optional(Auth::guard('admin')->user())->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized access. Admin privileges required.');
        }


        return $next($request);
    }
}

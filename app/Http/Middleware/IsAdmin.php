<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::guard('admin')->check()) {
            return redirect()->route('login.show')->with('error', 'Please login first.');
        }

        $user = Auth::guard('admin')->user();
        if (! in_array($user?->role, ['admin', 'employee'], true)) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}

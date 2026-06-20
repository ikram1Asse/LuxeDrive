<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsEmployeeReadOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login.show')->with('error', 'Please login first.');
        }

        // Employees are allowed if their employe role is not null.
        if (!optional(Auth::guard('admin')->user())->role) {
            return redirect('/')->with('error', 'Unauthorized access. Employee account required.');
        }


        return $next($request);
    }
}

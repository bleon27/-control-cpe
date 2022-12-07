<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityRole
{
    public function handle(Request $request, Closure $next)
    {
        /*
        if (auth()->user()->role->name === "Seguridad") {
            dd("Seguridad");
        }
        return redirect()->route('dashboard');*/
        return $next($request);

    }
}

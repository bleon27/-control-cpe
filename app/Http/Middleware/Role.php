<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    public function handle(Request $request, Closure $next)
    {
        /*if (auth()->user()->role->name === "Administrador") {
            dd("Administrador");
        }
        return redirect()->route('dashboard');*/
        return $next($request);

    }
}

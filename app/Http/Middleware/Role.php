<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role->name != "Administrador") {
            return redirect()->route('access.control.index');
        }

        return $next($request);
    }
}

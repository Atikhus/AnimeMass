<?php

namespace App\Http\Middleware;

use Closure;

class ApiMiddleware
{
    public function handle($request, Closure $next)
    {
        if (! $request->user()) {
            return redirect('control_panel');
        }
    
        // Lógica para manejar la API
        return $next($request);
    }
}

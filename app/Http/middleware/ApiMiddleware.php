<?php

namespace App\Http\Middleware;

use Closure;

class ApiMiddleware
{
    public function handle($request, Closure $next)
    {
        // Lógica para manejar la API
        return $next($request);
    }
}

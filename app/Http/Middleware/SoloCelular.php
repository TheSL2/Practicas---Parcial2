<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class SoloCelular
{
    public function handle(Request $request, Closure $next): Response
    {
        $dispositivo = strtolower($request->header('User-Agent'));

        $palabrasCelular = ['android', 'iphone', 'ipad', 'mobile'];

        if (Str::contains($dispositivo, $palabrasCelular) && !$request->is('movil')) {
            return redirect('/movil');
        }

        return $next($request);
    }
}
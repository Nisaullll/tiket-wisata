<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()?->usertype !== 'admin') {
            abort(403, 'Halaman ini hanya untuk administrator.');
        }

        return $next($request);
    }
}
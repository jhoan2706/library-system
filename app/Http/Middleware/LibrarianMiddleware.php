<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LibrarianMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->isLibrarian()) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}

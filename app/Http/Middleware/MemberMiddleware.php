<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->isMember()) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}

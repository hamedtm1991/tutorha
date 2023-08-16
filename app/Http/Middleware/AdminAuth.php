<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ($request->user()->hasAnyRole('super-admin'))
        {
            return $next($request);
        }

        abort(403);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param integer $type
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->type == 1) {
            return $next($request);
        } else if (Auth::check() && Auth::user()->type == 2) {
            return $next($request);
        }
        return abort(403, 'Unauthorized action.');
    }
}

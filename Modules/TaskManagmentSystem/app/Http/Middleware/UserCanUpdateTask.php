<?php

namespace Modules\TaskManagmentSystem\app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserCanUpdateTask
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if ()
        return $next($request);
    }
}

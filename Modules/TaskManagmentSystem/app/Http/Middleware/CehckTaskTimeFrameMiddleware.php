<?php

namespace Modules\TaskManagmentSystem\app\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CehckTaskTimeFrameMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $task = $request->route('task'); // Task instance due to route model binding

        // Admins can always proceed
        if ($user->isAdmin()) {
            return $next($request);
        }

        // Check if the task was created within the last 24 hours
        $creationDate = Carbon::parse($task->created_at);
        if (Carbon::now()->diffInHours($creationDate) > 24) {
            // If it's been more than 24 hours since the task was created
            return response()->json(['message' => 'Unauthorized: This task can no longer be modified as it is older than 24 hours'], 403);
        }

        return $next($request);
    }
}

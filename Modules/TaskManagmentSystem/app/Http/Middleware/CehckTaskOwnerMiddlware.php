<?php

namespace Modules\TaskManagmentSystem\app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\TaskManagmentSystem\app\Models\User;
class CehckTaskOwnerMiddlware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        $task = $request->route('task');  // Task instance due to route model binding

        // Allow admins to proceed or if the user is the owner of the task
        if ($user->isAdmin() || $task->assinee_id === $user->id) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized: You do not own this task or you are not an admin'], 403);
    }
}

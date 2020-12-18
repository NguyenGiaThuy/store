<?php

namespace App\Http\Middleware;

use App\Http\Controllers\RoleController;
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
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if(strpos($request->getRequestUri(), 'admin') != false) {
            if($user->role_id != 2) {
                abort(403, 'Unauthorized action');
            }
        }

        if(strpos($request->getRequestUri(), 'editor') != false) {
            if($user->role_id != 3) {
                abort(403, 'Unauthorized action');
            }
        }

        return $next($request);
    }
}

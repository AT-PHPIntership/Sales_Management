<?php

namespace App\Http\Middleware;

use Closure;
use \Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request request
     * @param \Closure                 $next    next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get the required roles from the route
        $roles = $this->getRequiredRoleForRoute($request->route());
        // Check if a role is required for the route, and
        // if so, ensure that the user has that role.
        if (Auth::user()->hasRole($roles) || !$roles) {
            return $next($request);
        }
        // Raise an exception, redirect to 403 page if the user have no roles
        abort(403, 'Unauthorized action.');
    }

    /**
     * Get all roles
     *
     * @param \Illuminate\Routing\Route $route route handling the request.
     *
     * @return Array
     */
    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();
        return isset($actions['roles']) ? $actions['roles'] : null;
    }
}

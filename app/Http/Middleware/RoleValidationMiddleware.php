<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleValidationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if an user is logged in
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // check if the user has the role of moderator or super  admin
        if ($request->user()->role_id !== UserRole::Moderator && $request->user()->role_id !== UserRole::SuperAdministrator) {

            // dd($request->user()->role_id);
            abort(403, 'You are not authorized to access this page.');
        }
        return $next($request);
    }
}

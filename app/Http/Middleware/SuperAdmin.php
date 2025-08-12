<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::user()) {
            return redirect()->route('login')->with('status', 'You must be logged in to view this page.');
        }

        // Define a constant for the super admin role ID
        $superAdminRoleId = defined('SUPER_ADMIN_ROLE_ID') ? SUPER_ADMIN_ROLE_ID : 1;

        // Optionally, use a method like isSuperAdmin() if available on the User model
        if (method_exists(Auth::user(), 'isSuperAdmin')) {
            $isSuperAdmin = Auth::user()?->isSuperAdmin();
        } else {
            $isSuperAdmin = Auth::user()?->roles_id == $superAdminRoleId;
        }

        if (!$isSuperAdmin) {
            $notifications = [
                'message' => 'You do not have permission to view this page.',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with('notifications', $notifications);
        }

        return $next($request);
    }
}

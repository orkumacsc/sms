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
            return redirect()->route('main_login');
        }

        if(Auth::user()->usertype != 1) {

            $notifications = array(
                'message' => 'You are not allowed to view this page',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notifications);
        }

        return $next($request);
    }
}

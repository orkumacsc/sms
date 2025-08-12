<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Students
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
        if (!auth()->check()) {
            return redirect()->route('login.form')->with('status', 'You must be logged in to view this page.');
        }

        if (auth()->user()->roles_id != 4) {
            return redirect()->route('login.form')->with('status', 'You do not have permission to view this page.');
        }

        return $next($request);
    }
}

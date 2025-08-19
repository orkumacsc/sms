<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Staff;

class ClassTeacher
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
        // Check if the authenticated user is a teacher
        $teacher = Staff::where('user_id', auth()->id())->first();

        // Fetch classes assigned to the teacher
        $isClassTeacher = $teacher && $teacher->classGroup()->exists();

        // If the teacher is not assigned to any class, redirect with an error message        
        if (!$isClassTeacher) {
            return redirect()->route('staff.dashboard')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}

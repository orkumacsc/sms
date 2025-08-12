<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function dashboard()
    {
        // Ensure the user is authenticated and has the correct role
        if (Auth::check() && Auth::user()->roles_id === 1) {
            return view('admin.admin_dashboard');
        }

        // Redirect to login if not authenticated or unauthorized
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }
}

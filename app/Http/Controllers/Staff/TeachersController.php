<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\EmergencyContact;
use App\Models\Staff;
use Auth;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    /**
     * Show the staff dashboard.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function dashboard()
    {
        // Ensure the user is authenticated and has the correct role
        if (Auth::check() && Auth::user()->roles_id === 3) {
            return view('Teachers.dashboard');
        }

        // Redirect to login if not authenticated or unauthorized
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }
}

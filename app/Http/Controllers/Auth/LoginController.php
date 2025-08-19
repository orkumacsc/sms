<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
     * Login Controller
     * Handles user authentication and redirection based on roles.
     */

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle user login and redirect based on user role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'remember_me' => 'string',
        ]);

        // Retrieve credentials from the request
        $credentials = $request->only('email', 'password');
        $remember_me = $request->input('remember_me', false);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials, $remember_me)) {

            session()->regenerate();

            // Authentication passed, redirect based on user role
            $user = Auth::user();
            if ($user->roles_id === 1) {
                return redirect()->intended('admin/dashboard');

            } elseif ($user->roles_id === 3) {

                $profile = Staff::where('user_id', $user->id)->first();
                if ($profile) {
                    // Prepare staff profile data for session
                    $staff_profile = [];
                    $staff_profile['fullName'] = "$profile->surname, $profile->firstname $profile->middlename";
                    $staff_profile['photo'] = $profile->staff_passport;
                    $staff_profile['staff_id'] = $profile->staff_no;
                    $staff_profile['gender'] = $profile->gender_id;

                    session(['staff_profile' => $staff_profile]);

                    return redirect()->intended('staff/dashboard');
                }
            } elseif ($user->roles_id === 4) {
                $profile = Students::where('login_id', $user->id)->first();
                if ($profile) {
                    // Prepare student profile data for session
                    $student_profile = [];
                    $student_profile['fullName'] = "$profile->surname, $profile->firstname $profile->middlename";
                    $student_profile['photo'] = $profile->student_passport;
                    $student_profile['student_id'] = $profile->admission_no;
                    $student_profile['gender'] = $profile->gender;

                    session(['student_profile' => $student_profile]);

                    return redirect()->intended('student/dashboard');
                } elseif ($user->roles_id === 7) {
                    return redirect()->intended('staff/dashboard');
                } else {
                    Auth::logout();
                    return redirect()->back()->withErrors(['Unauthorized role.']);
                }
            }
        }

        // Authentication failed, redirect back with error
        return redirect()->back()->withErrors(['Invalid credentials.']);
    }

    /**
     * Handle user Logout, flush session and redirect to login page
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with([
            'message' => 'You have been logged out successfully.',
            'alert-type' => 'success'
        ]);
    }
}
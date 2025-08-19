<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Students;
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

    /**
     * List students for the form teacher.
     *
     * @return \Illuminate\View\View
     */
    public function viewStudents(Request $request){
        // Logic to retrieve and display students
        $teacher = Staff::where('user_id', Auth::id())->first();

        // If you want the current teacher's class group:
        $class_id = $teacher ? $teacher->classGroup()->pluck('school_classes.id') : collect();
        
        $students = Students::whereHas('schoolClasses', function($query) use($class_id) {
            $query->whereIn('school_classes.id', $class_id);
        })->get();

        // dd($students); // Uncomment for debugging
        return view('Teachers.students.view', compact('class_id', 'students'));
    }
    
    public function listAnnouncements($composer_id)
    {
        // Logic to retrieve and display the list of sent announcements
    }

    public function listSentAnnouncements($composer_id)
    {
        // Logic to retrieve and display the list of sent announcements
    }
}

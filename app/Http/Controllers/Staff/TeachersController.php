<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Middleware\ClassTeacher;
use App\Models\ClassTeachers;
use App\Models\Departments;
use App\Models\SchoolArms;
use App\Models\SchoolClass;
use App\Models\StudentClass;
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
        $staff_id = Staff::where('user_id', Auth::id())->value('id');
        $teacherClasses = ClassTeachers::with('class', 'arm', 'academicSession', 'department')
            ->where('teacher_id', $staff_id)
            ->where('active_status', 1)
            // Assuming you want to filter by the current academic session
            ->where('academic_sessions_id', session('current_academic_session_id'))
            ->get();

        return view('Teachers.dashboard', compact('teacherClasses'));
    }

    /**
     * List students for the form teacher.
     *
     * @return \Illuminate\View\View
     */
    public function viewStudents(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'school_classes_id' => 'required|integer|exists:school_classes,id',
            'departments_id' => 'required|integer|exists:departments,id',
            'school_arms_id' => 'required|integer|exists:school_arms,id',
        ]);

        $school_classes_id = $request->school_classes_id;
        $school_arms_id = $request->school_arms_id;
        $departments_id = $request->departments_id;

        $teacherStudents = StudentClass::with('student.house', 'student.gender')
            ->where('class_id', $school_classes_id)
            ->where('school_arm_id', $school_arms_id)
            ->where('academic_session_id', currentAcademicSession()->id) // Assuming you want to filter by the current academic session
            ->get();
        $schoolClass = SchoolClass::find($school_classes_id);
        $schoolArm = SchoolArms::find($school_arms_id);
        $department = Departments::find($departments_id ?? 1);        
        // dd($students);

        return view('Teachers.students.view', compact('teacherStudents', 'schoolClass', 'schoolArm', 'department'));
    }

    public function myRoutine(Request $request)
    {
        // Logic for the teacher's routine
    }

    public function markAttendance(Request $request)
    {
        // Logic to mark attendance for students
    }

    public function viewStudentProfile($id)
    {
        // Logic to view a student's profile
    }
}

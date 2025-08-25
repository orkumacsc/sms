<?php

namespace App\Http\Controllers\admin\Academics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\SchoolClass;
use App\Models\SchoolArms;
use App\Models\Departments;
use App\Models\SchoolSessions;
use App\Models\ClassTeachers;

class FormMastersAssignmentController extends Controller
{
    // Staff Class Assignment
    public function index()
    {
        $data['staff'] = Staff::all();
        $data['classes'] = SchoolClass::all();
        $data['arms'] = SchoolArms::all();
        $data['departments'] = Departments::all();
        $data['schoolSessions'] = SchoolSessions::all();
        $data['classTeachers'] = ClassTeachers::with(['class', 'arm', 'academicSession', 'department', 'teacher'])
        ->where('academic_sessions_id', currentAcademicSession()->id)
        ->get();

        return view('backend.Staff.staff_classes', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'school_classes_id' => 'required|exists:school_classes,id',
            'school_arms_id' => 'required|exists:school_arms,id',
            'departments_id' => 'required|exists:departments,id',
            'academic_sessions_id' => 'required|exists:school_sessions,id',
        ]);

        $exists = ClassTeachers::where([            
            ['school_classes_id', $request->school_classes_id],
            ['school_arms_id', $request->school_arms_id],
            ['departments_id', $request->departments_id],
            ['academic_sessions_id', $request->academic_sessions_id],
        ])->exists();

        if ($exists) {
            return redirect()->back()->with([
                'message' => 'This class has already been assigned to a teacher.',
                'alert-type' => 'error'
            ]);
        }
        // Enforce maximum of two classes per teacher
        $assignedCount = ClassTeachers::where('teacher_id', $request->staff_id)->count();
        if ($assignedCount >= 2) {
            return redirect()->back()->with([
                'message' => 'A teacher can only be assigned to a maximum of two classes.',
                'alert-type' => 'error'
            ]);
        }

        ClassTeachers::Create(
            [
                'teacher_id' => $request->staff_id,
                'school_classes_id' => $request->school_classes_id,
                'school_arms_id' => $request->school_arms_id,
                'departments_id' => $request->departments_id,
                'academic_sessions_id' => $request->academic_sessions_id,
                'assigned_by' => auth()->id()
            ]            
        );

        return redirect()->back()->with([
            'message' => 'Form Master assigned successfully.',
            'alert-type' => 'success'
        ]);
    }
}

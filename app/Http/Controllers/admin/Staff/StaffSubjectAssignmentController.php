<?php

namespace App\Http\Controllers\admin\staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\SchoolSubjects;
use App\Models\SchoolArms;
use App\Models\Departments;
use App\Models\SchoolSessions;
use App\Models\SchoolClass;
use App\Models\ClassSubjectTeacher;

class StaffSubjectAssignmentController extends Controller
{    
    /**
     * Display a listing of the staff subject assignments.
     */
    public function index()
    {
        $data['staff'] = Staff::all();
        $data['subjects'] = SchoolSubjects::all();
        $data['staffSubjects'] = Staff::whereHas('subjects')->with('subjects')->get();
        $data['classes'] = SchoolClass::all();
        $data['arms'] = SchoolArms::all();
        $data['departments'] = Departments::all();
        $data['schoolSessions'] = SchoolSessions::all();
        $data['teachingAssignments'] = ClassSubjectTeacher::with('teacher', 'subject', 'schoolClass', 'department', 'arm')->get();
        return view('backend.Staff.staff_subjects', $data);
    }

    /**
     * Store a newly created staff subject assignment in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'subject_id' => 'required|array',
            'subject_id.*' => 'exists:school_subjects,id',
        ]);
        // Check if the staff already has the subject assigned
        $staff = Staff::find($request->staff_id);
        if (!$staff) {
            return redirect()->back()->with([
                'message' => 'Staff not found.',
                'alert-type' => 'error'
            ]);
        }

        $staff->subjects()->sync($request->subject_id);

        return redirect()->back()->with([
            'message' => 'Subjects assigned successfully.',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Update the specified staff subject assignment in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'subject_id' => 'required|array',
            'subject_id.*' => 'exists:school_subjects,id',
        ]);

        // Update the staff's subjects
        $staff = Staff::find($request->staff_id);
        if (!$staff) {
            return redirect()->back()->with([
                'message' => 'Staff not found.',
                'alert-type' => 'error'
            ]);
        }

        $staff->subjects()->sync($request->subject_id);

        return redirect()->back()->with([
            'message' => 'Subjects updated successfully.',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified staff subject assignment from storage.
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);
        if (!$staff) {
            return redirect()->back()->with([
                'message' => 'Staff not found.',
                'alert-type' => 'error'
            ]);
        }

        $staff->subjects()->detach();

        return redirect()->back()->with([
            'message' => 'Subjects removed successfully.',
            'alert-type' => 'success'
        ]);
    }
}

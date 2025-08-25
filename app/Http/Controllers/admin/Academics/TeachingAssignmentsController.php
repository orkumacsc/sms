<?php

namespace App\Http\Controllers\admin\Academics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassSubjectTeacher;

class TeachingAssignmentsController extends Controller
{   
    /**
     * Store a newly created teaching assignment in storage.
     */
    public function store(Request $request)
    {        
        try {
            $validatedData = $request->validate([
                'teacher_id' => 'required|integer|exists:staff,id',
                'school_subjects_id' => 'required|integer|exists:school_subjects,id',
                'school_classes_id' => 'required|integer|exists:school_classes,id',
                'academic_sessions_id' => 'required|integer|exists:school_sessions,id',
                'departments_id' => 'nullable|integer|exists:departments,id',
                'school_arms_id' => 'nullable|integer|exists:school_arms,id'                
            ]);
        } catch (\Exception $e) {
            return back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }

        try {
            $exists = ClassSubjectTeacher::where([
                ['school_subjects_id', $validatedData['school_subjects_id']],
                ['school_classes_id', $validatedData['school_classes_id']],
                ['academic_sessions_id', $validatedData['academic_sessions_id']],
            ])
            ->when(isset($validatedData['departments_id']), function ($query) use ($validatedData) {
                $query->where('departments_id', $validatedData['departments_id']);
            })
            ->when(isset($validatedData['school_arms_id']), function ($query) use ($validatedData) {
                $query->where('school_arms_id', $validatedData['school_arms_id']);
            })
            ->exists();

            if ($exists) {
                return back()->with([
                    'message' => 'This subject is already assigned to another teacher for the selected class and arm/department.',
                    'alert-type' => 'error'
                ]);
            }

            ClassSubjectTeacher::firstOrCreate([
                'teacher_id' => $validatedData['teacher_id'],
                'school_subjects_id' => $validatedData['school_subjects_id'],
                'school_classes_id' => $validatedData['school_classes_id'],
                'departments_id' => $validatedData['departments_id'] ?? null,
                'school_arms_id' => $validatedData['school_arms_id'] ?? null,
                'academic_sessions_id' => $validatedData['academic_sessions_id']
            ]);

            return back()->with([
                'message' => 'Teacher Teaching Assignments Assigned Successfully!',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Update the specified teaching assignment in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'teacher_id' => 'required|integer|exists:teachers,id',
            'school_subjects_id' => 'required|integer|exists:school_subjects,id',
            'school_classes_id' => 'required|integer|exists:school_classes,id',
            'departments_id' => 'integer|exists:departments,id',
            'school_arms_id' => 'integer|exists:school_arms,id',
            'academic_session_id' => 'required|integer|exists:school_sessions,id'
        ]);

        try {
            $assignment = ClassSubjectTeacher::find($id);
            if (!$assignment) {
                return back()->with([
                    'message' => 'Teaching assignment not found.',
                    'alert-type' => 'error'
                ]);
            }

            $assignment->update($validatedData);

            return back()->with([
                'message' => 'Teaching assignment updated successfully!',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Remove the specified teaching assignment from storage.
     */
    public function destroy($id)
    {
        try {
            $assignment = ClassSubjectTeacher::find($id);
            if (!$assignment) {
                return back()->with([
                    'message' => 'Teaching assignment not found.',
                    'alert-type' => 'error'
                ]);
            }

            $assignment->delete();

            return back()->with([
                'message' => 'Teaching assignment removed successfully!',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }
}

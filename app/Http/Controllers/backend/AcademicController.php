<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassDiscipline;
use App\Models\Departments;
use App\Models\SchoolArms;
use Illuminate\Http\Request;
use App\Models\SchoolSubjects;
use App\Models\Staff;
use App\Models\SchoolClass;
use App\Models\ClassSubjects;
use App\Models\SchoolSessions;
use App\Models\CurrentAcademicSeason;
use Auth;


class AcademicController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the form for creating school subjects.
     *
     * @return \Illuminate\View\View
     */
    public function SchoolSubjects()
    {
        $classDiscipline = ClassDiscipline::whereHas('subjects')->get();
        $data['disciplineSubject'] = $classDiscipline->map(fn($discipline) => $discipline->allSubjectsWithGlobal(7));        
        $data['SchoolClasses'] = SchoolClass::all();
        $data['SchoolSubjects'] = SchoolSubjects::where('is_global_compulsory', '!=', true)->get();
        $data['SchoolArms'] = SchoolArms::get();
        $data['departments'] = Departments::get(); 
        $data['academicSessions'] = SchoolSessions::get();
        $data['classDisciplines'] = ClassDiscipline::all()->map(fn($discipline) => $discipline->getDisciplineInfoAttribute());

        return view('backend.academics.school_subjects', $data);
    }

    /**
     * Store discipline subjects.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Expected $request->subjects_id structure:
     * [
     *     [
     *         'subject_id' => (int), // required, school_subjects.id
     *         'is_compulsory' => (bool), // optional, true/false
     *     ],
     *     ...
     * ]
     */
    public function storeDisciplineSubjects(Request $request)
    {       
        // Validate the request data
        try {
            $validatedData = $request->validate([
                'class_discipline_id' => 'required|exists:class_disciplines,id',
                'subjects_id' => 'required|array',
                'subjects_id.*.subject_id' => 'required|exists:school_subjects,id',
                'subjects_id.*.is_compulsory' => 'boolean',
                'academic_session_id' => 'required|exists:school_sessions,id'
            ]);
        } catch (\Exception $e) {
            dd($e);
            return back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }

        // Attempt to find the class discipline and sync subjects
        try {            
            $classDiscipline = ClassDiscipline::findOrFail($request->class_discipline_id);
            $syncData = [];
            foreach ($request->subjects_id as $key => $subject) {
                $syncData[] = [
                    'school_subjects_id' => $key,
                    'is_compulsory' => $subject['is_compulsory'] ?? false,
                    'school_sessions_id' => $request->academic_session_id
                ];
            }
            $classDiscipline->subjects()->syncWithoutDetaching($syncData);

            return back()->with([
                'message' => 'Discipline Subjects Added Successfully!',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {  
            // Handle any exceptions that occur during the process            
            return back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Store school subjects.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSchoolSubjects(Request $request)
    {
        $validatedData = $request->validate([
            'cross_curricular' => 'nullable|boolean',
            'subject_name' => 'required|string|max:255|unique:school_subjects',
        ]);

        $data = new SchoolSubjects();
        $data->subject_name = $request->subject_name;
        $data->cross_curricular = $request->cross_curricular ? 1 : 0; // Convert checkbox to boolean
        $data->save();

        // Return success notification
        return back()->with([
            'message' => 'Subject Added Successfully!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Store class subjects.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeClassSubjects(Request $request)
    {
        $validatedData = $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
            'department_id' => 'required'
        ]);

        try {
            $reords = [];
            foreach ($request->subject_id as $subject_id => $subjects) {
                $record = [];
                $record['class_id'] = $request->class_id;
                $record['department_id'] = $request->department_id;
                $record['subject_id'] = $subject_id;
                $records[] = $record;
            }

            $class_subjects = new ClassSubjects();
            $class_subjects->create($records);         

            return back()->with([
                'message' => 'Subject(s) Successfully Assigned to Class!',
                'alert-type' => 'success'
            ]);

        } catch (\Exception $e) {            
            return back()->with([
                'message' => $e,
                'alert-type' => 'error'
            ]);
        }
    }


}

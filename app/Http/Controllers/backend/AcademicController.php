<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
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

    public function SchoolSubjects()
    {
        $data['ClassSubjects'] = ClassSubjects::join('school_classes', 'school_classes.id', 'class_subjects.class_id')
            ->join('school_subjects', 'school_subjects.id', 'class_subjects.subject_id')
            ->join('departments', 'departments.id', 'class_subjects.department_id')
            ->select('subject_name', 'classname', 'class_subjects.id as subject_id','departments.name as department')->get();

        $data['SchoolClasses'] = SchoolClass::all();
        $data['SchoolSubjects'] = SchoolSubjects::all();
        $data['SchoolArms'] = SchoolArms::get();
        $data['departments'] = Departments::get();

        return view('backend.academics.school_subjects', $data);
    }

    public function storeSchoolSubjects(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:school_subjects',
        ]);

        $data = new SchoolSubjects();
        $data->subject_name = $request->subject_name;
        $data->save();

        $notifications = array(
            'message' => 'Subject Added Successfully!',
            'alert-type' => 'success'
        );

        return back()->with($notifications);
    }

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

            $notifications = array(
                'message' => 'Subject(s) Successfully Assigned to Class!',
                'alert-type' => 'success'
            );

            return back()->with($notifications);

        } catch (\Exception $e) {

            $notifications = array(
                'message' => $e,
                'alert-type' => 'error'
            );
            return back()->with($notifications);
        }

    }


}

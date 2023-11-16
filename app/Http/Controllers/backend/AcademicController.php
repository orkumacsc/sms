<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
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
    
    public function SchoolSubjects(){
        $data['allData'] = SchoolSubjects::all();

        return view('backend.academics.school_subjects', $data);
    }

    public function StoreSchoolSubjects(Request $request){
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

        return redirect()->route('school_subjects')->with($notifications);
    }

    public function AssignSubject(){
        if(Auth::user()->usertype != 'Super Admin'){
            return redirect()->route('login');
       } else {
            $data['ClassSubjects'] = ClassSubjects::join('staff', 'staff.id', 'class_subjects.teacher_id')->join('school_classes', 'school_classes.id', 'class_subjects.class_id')
                ->join('school_subjects', 'school_subjects.id', 'class_subjects.subject_id')
                    ->select('school_subjects.name as subjects', 'school_classes.classname as class', 'staff.surname as surname', 
                    'staff.firstname as firstname', 'staff.middlename as middlename', 'staff.id as staff_id', 'class_subjects.id as id')->get();
            $data['SchoolClasses'] = SchoolClass::all();
            $data['SchoolSubjects'] = SchoolSubjects::all();
            $data['Staff'] = Staff::all();


            return view('backend.academics.assign_subjects_form', $data);
       }
    }

    public function StoreAssignedSubject(Request $request){
        $validatedData = $request->validate([
            'class_id' => 'required',
            'teacher_id' => 'required',
            'subject_id' => 'required',            
        ]);

        $academicId = CurrentAcademicSeason::get('session_id');

        $data = new ClassSubjects();
        $data->subject_id = $request->subject_id;
        $data->class_id = $request->class_id;
        $data->teacher_id = $request->teacher_id;
        // $data->session_id = AcademicId();
        $data->save();

        $notifications = array(
            'message' => 'Subject Assigned Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('assign_subject')->with($notifications);
    }


}

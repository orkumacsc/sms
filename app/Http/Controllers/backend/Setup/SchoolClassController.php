<?php

namespace App\Http\Controllers\backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\ClassSubjects;
use App\Models\SchoolClassArms;
use App\Models\SchoolSessions;
use App\Models\SchoolClassInfo;
use Illuminate\Http\Request;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Auth;

class SchoolClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    
    public function SchoolClass(){
        $data['allData'] = SchoolClass::all();
        $data['sessions'] = SchoolSessions::all();
        return view('backend.setup.school_classes',$data);
    }


    public function StoreSchoolClass(Request $request){
        $validatedData = $request->validate([
            'class' => 'required',
            'session' => 'required',
        ]);

        $data = new SchoolClass();
        $data->classname = $request->class;
        $data->session_created = $request->session;
        $data->save();

        return redirect()->route('school_classes');
    }

    public function ClassProfile($class_id) {
        $data['ClassArms'] = SchoolClassArms::join('school_classes','school_classes.id', 'school_class_arms.class_id')
        ->join('school_arms','school_arms.id','school_class_arms.arm_id')
            ->where('class_id',$class_id)->get();
            
        $data['ClassSubjects'] = ClassSubjects::where('class_id',$class_id)->get();
        $data['class_id'] = $class_id;

        return view('backend.setup.class_profile', $data);
    }

    public function StoreClassInfo(Request $request) {
        $validateData = $request->validate([
            'total_subjects_offered' => 'required',
            'academic_session_id' => 'required',
            'class_id' => 'required'
        ]);

        $SchoolClassInfo = new SchoolClassInfo();
        $SchoolClassInfo->class_id = $request->class_id;
        $SchoolClassInfo->total_subjects_offered = $request->total_subjects_offered;
        $SchoolClassInfo->academic_session_id = $request->academic_session_id;
        $SchoolClassInfo->created_by = Auth::user()->id;
        $SchoolClassInfo->save();


        $notifications = array(
            'message' => 'Total number of subjects offered by class successfully updated.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notifications);
    }
};

<?php

namespace App\Http\Controllers\backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\ClassSubjects;
use App\Models\SchoolClassArms;
use App\Models\SchoolSessions;
use Illuminate\Http\Request;
use App\Models\SchoolClass;

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

    public function ClassProfile($id) {
        $data['ClassArms'] = SchoolClassArms::find($id);
        $data['ClassSubjects'] = ClassSubjects::find($id);

        return view('backend.setup.class_profile', $data);
    }

    public function ClassConfiguration($id) {
        $data['ClassArms'] = SchoolClassArms::find($id);        

        return view('backend.setup.class_profile', $data);
    }
};

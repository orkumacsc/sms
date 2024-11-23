<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolClassArms;
use Illuminate\Http\Request;
use App\Models\SchoolArms;
use App\Models\SchoolClass;

class SchoolArmsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function SchoolArm(){

        $data['SchoolArms'] = SchoolArms::all();  
        $data['SchoolClasses'] = SchoolClass::all();
        $data['ClassArms'] = SchoolClassArms::join('school_classes','school_classes.id', 'school_class_arms.class_id')
            ->join('school_arms','school_arms.id','school_class_arms.arm_id')
                ->get()->all();
        
        return view('backend.setup.school_arms',$data);
    }

    public function StoreClassArm(Request $request) {
        
            SchoolClassArms::updateOrCreate(
                ['arm_id' => $request->arm_id, 'class_id' => $request->class_id],
                ['active_status' => 1]
            );

            $notifications = array(
                'message' => 'Arm Successfully Assigned to Class',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notifications);
        
    }

    public function StoreSchoolArm(Request $request) {
        
        SchoolArms::updateOrCreate(
            ['arm_name' => strtoupper($request->arm_name)],
            ['active_status' => 1]
        );

        $notifications = array(
            'message' => 'School Arm Successfully Created',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notifications);
    
}
}

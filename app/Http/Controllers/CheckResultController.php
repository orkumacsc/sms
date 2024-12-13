<?php

namespace App\Http\Controllers;

use App\Models\SchoolArms;
use App\Models\SchoolClass;
use App\Models\SchoolSessions;
use App\Models\SchoolTerm;
use Illuminate\Http\Request;

class CheckResultController extends Controller
{
    //

    public function index(){
        $data['school_classes'] = SchoolClass::all();
        $data['school_arms'] = SchoolArms::all();
        $data['school_academic_sessions'] = SchoolSessions::all();
        $data['school_terms'] = SchoolTerm::all();

        return view('Students.check_result',$data);
    }

    public function process(Request $request){
        
        $notifications = [
            'message' => 'Result not yet released! Check back later!',
            'alert-type' => 'info'
        ];

        return back()->with($notifications);
    }
}

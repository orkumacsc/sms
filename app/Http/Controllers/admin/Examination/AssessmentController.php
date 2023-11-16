<?php

namespace App\Http\Controllers\Admin\Examination;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\SchoolHouses;
use App\Models\Gender;
use App\Models\SchoolClass;
use App\Models\SchoolSessions;
use App\Models\SchoolTerm;
use App\Models\SchoolArms;
use App\Models\Assessment_Types;
use App\Models\SchoolAssessments;
use Auth;

class AssessmentController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function Index(){

       if(Auth::user()->usertype != 'Super Admin'){
            return redirect()->route('login');
       } else {
            $data['assTypes'] = Assessment_Types::all();
            $data['Classes'] = SchoolClass::all();
            return view('backend.Examination.ass_type_add', $data);
       }
    }

    public function StoreAssessment(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'percentage' => 'required',
        ]);

        $data = new Assessment_Types();
        $data->name = $request->name;
        $data->percentage = $request->percentage;
        $data->save();

        return redirect()->route('ass_registration');
    }


    public function AssIndex(){

        if(Auth::user()->usertype != 'Super Admin'){
             return redirect()->route('login');
        } else {
             $data['assTypes'] = Assessment_Types::all();
             $data['Classes'] = SchoolClass::all();
             $data['Assessments'] = SchoolAssessments::join('school_classes', 'school_classes.id', '=', 'school_assessments.class_id')->orderBy('school_classes.id', 'ASC')->orderBy('school_assessments.id', 'ASC')
                ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')->get()->all();

             return view('backend.Examination.assessment', $data);
        }
     }
 
     public function StoreAsignAssessment(Request $request){
         $validatedData = $request->validate([
             'asstype' => 'required',
             'class' => 'required',
         ]);
 
         $data = new SchoolAssessments();
         $data->ass_type_id = $request->asstype;
         $data->class_id = $request->class;
         $data->save();
 
         return redirect()->route('asign_assessment');
     }

     public function ScoreSheetIndex(){

        if(Auth::user()->usertype != 'Super Admin'){
             return redirect()->route('login');
        } else {
             $data['SchoolClasses'] = SchoolClass::all();
             $data['SchoolSessions'] = SchoolSessions::all();
             $data['SchoolTerm'] = SchoolTerm::all();
             $data['SchoolArms'] = SchoolArms::all();

             return view('backend.Examination.score_sheet_form', $data);
        }
     }


     public function ViewScoreSheet(Request $request){

        if(Auth::user()->usertype != 'Super Admin'){
             return redirect()->route('login');
        } else {
             $data['current_session'] = SchoolSessions::find($request->sid);
             $data['SchoolClasses'] = SchoolClass::find($request->class);
             $data['SchoolArms'] = SchoolArms::find($request->class_arm);             
             $data['current_term'] = SchoolTerm::find($request->term_id);             
             $data['Students'] = Students::where('class','=',$request->class)->where('classarm_id','=',$request->class_arm)->orderBy('students.surname', 'ASC')->get()->all();
             $data['Assessments'] = SchoolAssessments::where('class_id', '=', $request->class)->join('school_classes', 'school_classes.id', '=', 'school_assessments.class_id')
                ->orderBy('school_classes.id', 'ASC')->orderBy('school_assessments.id', 'ASC')
                ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')->get()->all();

             return view('backend.Examination.score_sheet_view', $data);
        }
     }
    
}

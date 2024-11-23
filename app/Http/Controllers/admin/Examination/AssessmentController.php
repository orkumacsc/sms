<?php

namespace App\Http\Controllers\Admin\Examination;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use DB;
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
       
            $data['assTypes'] = Assessment_Types::all();
            $data['Classes'] = SchoolClass::all();
            return view('backend.Examination.ass_type_add', $data);
       
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
        
             $data['assTypes'] = Assessment_Types::all();
             $data['Classes'] = SchoolClass::all();
             $data['Assessments'] = SchoolAssessments::join('school_classes', 'school_classes.id', '=', 'school_assessments.class_id')->orderBy('school_classes.id', 'ASC')->orderBy('school_assessments.id', 'ASC')
                ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')->get()->all();

             return view('backend.Examination.assessment', $data);
        
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

     public function ScoreSheetIndex()
     {
          $data['SchoolClasses'] = SchoolClass::all();
          $data['SchoolSessions'] = SchoolSessions::all();
          $data['SchoolTerm'] = SchoolTerm::all();
          $data['SchoolArms'] = SchoolArms::all();

          return view('backend.Examination.score_sheet_form', $data);        
     }


     public function ViewScoreSheet(Request $request)
     {        
          try{
               $rollCheck = StudentClass::select('roll_number')
               ->where('class_id', $request->class)
                    ->where('school_arm_id', $request->class_arm)
                         ->where('academic_session_id', $request->sid)
                              ->get();

               $isRollNull = DB::table('student_classes')->select('student_id')
                    ->where('class_id', $request->class)
                         ->where('school_arm_id', $request->class_arm)
                              ->where('academic_session_id', $request->sid)
                                   ->where('roll_number', null)
                                        ->get();
               
               $data['current_session'] = SchoolSessions::find($request->sid);
               $data['SchoolClasses'] = SchoolClass::find($request->class);
               $data['SchoolArms'] = SchoolArms::find($request->class_arm);             
               $data['current_term'] = SchoolTerm::find($request->term_id);
               $data['Students'] = StudentClass::join('students', 'students.students_id','student_classes.student_id')
                    ->where('class_id','=',$request->class)
                         ->where('school_arm_id','=',$request->class_arm)
                              ->where('academic_session_id',$request->sid)
                                   ->orderBy( $rollCheck->count() ? 'student_classes.roll_number' : 'students.surname', 'ASC')->get()->all();
               $data['Assessments'] = SchoolAssessments::where('class_id', '=', $request->class)->join('school_classes', 'school_classes.id', '=', 'school_assessments.class_id')
                    ->orderBy('school_classes.id', 'ASC')->orderBy('school_assessments.id', 'ASC')
                    ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')->get()->all();
               
               
               $notifications = [
                    'message' => 'There are no students in the selected class.',
                    'alert-type' => 'info'
               ];

               $roll_generate_notifications = [
                    'message' => 'There are students in the selected class without register numbers. Please generate register numbers.',
                    'alert-type' => 'info'
               ];

               $request_data = [
                    'class_id' => $request->class, 
                    'class_arm' => $request->class_arm,
                    'academic_session' => $request->sid,
                    'term_id' => $request->term_id,
               ];

               return    count($data['Students']) ? 
                              (count($isRollNull) ? 
                                   redirect('Students/GenerateRollNumber')
                                        ->with($roll_generate_notifications)
                                             ->with($request_data) : 
                         view('backend.Examination.score_sheet_view', $data) ) : 
                              back()->with($request_data)->with($notifications);

          } catch(\Exception $e) {
               $notifications = [
                    'message' => $e,
                    'alert-type' => 'error'
                    ];
               return redirect()->back()->with($notifications);
          }
     }
         
}

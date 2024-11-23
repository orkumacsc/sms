<?php

namespace App\Http\Controllers\Admin\Examination;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\SchoolClass;
use App\Models\SchoolSessions;
use App\Models\SchoolTerm;
use App\Models\SchoolArms;
use App\Models\MarksRegisters;
use App\Models\ResultPositions;
use Auth;


class ExaminationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function Index()
    {       
          try {
               $data['SchoolClasses'] = SchoolClass::all();
               $data['SchoolArms'] = SchoolArms::all();
               return view('backend.Examination.exam_card', $data);

          } catch(\Exception $e) {
               $notifications = [
                    'message' => 'Error processing request',
                    'alert-type' => 'error'
               ];

               return back()->with($notifications);
          }       
    }


    public function GenerateExamCard(Request $request)
    {      
          try {
               $data['Students'] = StudentClass::join('students', 'students.students_id', '=', 'student_classes.student_id')
                    ->orderBy('students.surname', 'ASC')
                         ->join('school_classes', 'school_classes.id', '=', 'student_classes.class_id')
                              ->join('school_arms', 'school_arms.id', '=', 'student_classes.school_arm_id')
                                   ->join('genders', 'genders.id', '=', 'students.gender')
                                        ->where('class_id','=',$request->class)
                                             ->where('school_arm_id','=',$request->arm_id)
                                                  ->where('academic_session_id','=',Active_Session()->id)->get()->all();

               $notifications = [
                    'message' => 'No Student(s) found in the selected class for '. Active_Session()->name . ' academic session',
                    'alert-type' => 'info'
               ];
               return count($data['Students']) ? view('backend.Examination.exam_card_view', $data) : back()->with($notifications);
          } catch(\Exception $e){
               
               $notifications = [
                    'message' => 'System could not generate students\' exam card.',
                    'alert-type' => 'error'
               ];

               return back()->with($notifications);
          }      
    }

    public function Attendance()
    {        
          $data['SchoolClasses'] = SchoolClass::all();
          $data['SchoolArms'] = SchoolArms::all();
          return view('backend.Examination.exam_attendance', $data);        
     }
 
 
     public function AttendanceGenerate(Request $request)
     {        
          try {                       
               $data['current_class'] = SchoolClass::find($request->class);
               $data['class_arm'] = SchoolArms::find($request->class_arm);
               $data['Students'] = StudentClass::join('students', 'students.students_id', '=', 'student_classes.student_id')
                    ->orderBy('student_classes.roll_number', 'ASC')
                         ->join('school_classes', 'school_classes.id', '=', 'student_classes.class_id')
                              ->join('school_arms', 'school_arms.id', '=', 'student_classes.school_arm_id')
                                   ->join('genders', 'genders.id', '=', 'students.gender')
                                        ->where('class_id','=',$request->class)
                                             ->where('school_arm_id','=',$request->class_arm)
                                                  ->where('academic_session_id','=',Active_Session()->id)->get()->all();

               $notifications = [
                    'message' => 'No Student(s) found in the selected class for '. Active_Session()->name . ' academic session',
                    'alert-type' => 'info'
               ];
               return count($data['Students']) ? view('backend.Examination.attendance_view', $data) : back()->with($notifications);
          } catch(\Exception $e) {
               $notifications = [
                    'message' => 'System could not generate students\' attendance sheet.',
                    'alert-type' => 'error'
               ];

               return back()->with($notifications);
          }
        
     }

     public function computeResult()
     {
          $data['SchoolTerm'] = SchoolTerm::all();
          $data['SchoolSessions'] = SchoolSessions::all();
          $data['SchoolClasses'] = SchoolClass::all();
          $data['ClassArms'] = SchoolArms::all();

        return view('backend.Examination.compute_result', $data);
     }


     public function storeComputeResult(Request $request)
     {
          $session_id = $request->session_id;
          $term_id = $request->term_id;
          $class_id = $request->class_id;
          $arm_id = $request->arm_id;          
          try {
               $Result_details = MarksRegisters::select('student_id', 'class_id', 'total_scores', 'term_id', 'session_id', 'subject_id')
                    ->where('class_id', $class_id)
                         ->where('session_id', $session_id)
                              ->where('term_id', $term_id)
                                   ->where('total_scores', '>', 0)
                                        ->get()->groupBy('student_id');               

               
               $rows = [];
               foreach ($Result_details as $key => $Student_result) 
               {
                    $obtained_marks = 0;
                    $student_id;
                    $NumSubOffered = [];
                    foreach ($Student_result as $key => $Results) {
                         $obtained_marks += $Results->total_scores;
                         $student_id = $Results->student_id; 
                         $NumSubOffered[] =  $Results->subject_id;
                    }
                    
                    $row = [];
                    $row['session_id'] = $session_id;
                    $row['term_id'] = $term_id;
                    $row['class_id'] = $class_id;
                    $row['classarm_id'] = $arm_id;
                    $row['obtained_marks'] = $obtained_marks;
                    $row['student_id'] = $student_id;
                    $row['computed_by'] = Auth::user()->id;;
                    $row['total_subjects_offered'] = count($NumSubOffered);
                    $row['obtainable_marks'] = (count($NumSubOffered) * 100);
                    $rows[] = $row;
               }
              
               $ResultPositions = new ResultPositions();
               $ResultPositions->create($rows);


               // Students' Class Position
               $obtained_marks = ResultPositions::select('obtained_marks', 'id', 'class_position', 'average', 'obtainable_marks')->where('result_positions.class_id', $class_id)
                ->where('session_id', $session_id)->where('term_id', $term_id)
                    ->orderBy('obtained_marks', 'DESC')->get();
               $NumSubOffered = MarksRegisters::select('student_id', 'class_id', 'total_scores', 'term_id', 'session_id');
               $i = 0;
               $prev = 0;                 
               foreach ($obtained_marks as $id => $obtained_mark) {                                  

                    if($prev != $obtained_mark->obtained_marks)
                    {
                        $prev = $obtained_mark->obtained_marks ;
                        $i++;
                    }

                    $position = ResultPositions::find($obtained_mark->id);
                    $position->class_position = $i;
                    $position->average = ($obtained_mark->obtained_marks * 100)/$obtained_mark->obtainable_marks;                    
                    $position->save();
               }
               
          } catch (\Exception $e) {
               dd($e->getMessage());
          }
     }
}

<?php

namespace App\Http\Controllers\admin\Examination;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use DB;
use Illuminate\Http\Request;
use App\Models\CassScores;
use App\Models\Students;
use App\Models\SchoolClass;
use App\Models\SchoolTerm;
use App\Models\Assessment_Types;
use App\Models\SchoolAssessments;
use App\Models\SchoolArms;
use App\Models\SchoolSessions;
use App\Models\SchoolSubjects;
use App\Models\MarksRegisters;
use App\Models\ClassSubjects;
use App\Models\ResultPositions;

class CassViewController extends Controller
{
    public function index(){
        $data['SchoolClasses'] = SchoolClass::all();
        $data['SchoolTerm'] = SchoolTerm::all();
        $data['SchoolSessions'] = SchoolSessions::all();        
        $data['SchoolSubjects'] = SchoolSubjects::all();
        $data['ClassArms'] = SchoolArms::all();

        return view('backend.Examination.cass_scores_index',$data);
    }

    public function viewCass(Request $request){

        try {
            $data['current_session'] = SchoolSessions::find($request->academic_session_id);
            $data['SchoolClasses'] = SchoolClass::find($request->class_id);
            $data['class_arms'] = SchoolArms::find($request->class_arm_id);
            $data['current_term'] = SchoolTerm::find($request->term_id);
            $data['subject'] = SchoolSubjects::find($request->subject_id);
            $data['Students'] = StudentClass::join('students','students.students_id','student_classes.student_id')
            ->where('class_id','=',$request->class_id)
            ->where('school_arm_id',$request->class_arm_id)                
            ->where('academic_session_id',$request->academic_session_id)
            ->orderBy('roll_number')
            ->get();

            $data['CASS_Scores'] = CassScores::select('student_id','cass_type','scores')            
                ->where('class_id','=',$request->class_id)
                    ->where('class_arm_id',$request->class_arm_id)
                        ->where('academic_session_id',$request->academic_session_id)
                            ->where('term_id',$request->term_id)
                                ->where('subject_id',$request->subject_id)                                                                   
                                    ->get()->groupBy('cass_type');
            
            $data['Marks_Registers'] = MarksRegisters::where('class_id','=',$request->class_id)
            ->where('class_arm_id',$request->class_arm_id)
                ->where('academic_session_id',$request->academic_session_id)
                    ->where('term_id',$request->term_id)
                        ->where('subject_id',$request->subject_id)
                                    ->get()->all();


            $data['Assessments'] = SchoolAssessments::where('class_id', '=', $request->class_id)
            ->join('school_classes', 'school_classes.id', '=', 'school_assessments.class_id')
                ->orderBy('school_classes.id', 'ASC')->orderBy('school_assessments.id', 'ASC')
                    ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')
                        ->get();

            $cass_notification = [
                'message' => 'No Continuous Assessment Found the selected Class',
                'alert-type' => 'info'
            ];
            $students_notification = [
                'message' => 'There is no student in the selected class.',
                'alert-type' => 'info'
            ];
                
            return  isFound($data['Students']) ? 
                        (isFound($data['CASS_Scores']) ? 
                            view('backend.Examination.view_cass_scores', $data) :
                            back()->with($cass_notification)) :
                                back()->with($students_notification);

        } catch (\Exception $e) {
            
            $notifications = array([
                'message' => $e,
                'alert-type' => 'error'
            ]);

            return redirect()->back()->with($notifications);
        }
    }

    public function resultSummary()
    {
        $data['SchoolClasses'] = SchoolClass::all();
        $data['SchoolTerm'] = SchoolTerm::all();
        $data['SchoolSessions'] = SchoolSessions::all();
        $data['ClassArms'] = SchoolArms::all();
        
        return view('backend.Examination.results_summary',$data);
    }


    public function viewResultSummary(Request $request){

        try {
            // Retrieving Form Data
        $s_id = $request->s_id;
        $class_id = $request->class_id;
        $term_id = $request->term_id;        
        $classarm_id = $request->arm_id;

        $data['current_session'] = SchoolSessions::find($request->s_id);
        $data['SchoolClasses'] = SchoolClass::find($request->class_id);
        $data['current_term'] = SchoolTerm::find($request->term_id);
        $data['subject'] = SchoolSubjects::find($request->subject_id);             
        $data['Students'] = Students::where('class','=',$request->class_id)->orderBy('students.surname', 'ASC')->get()->all();
        
        $data['class_subjects'] = ClassSubjects::where('class_id', $class_id)
            ->join('school_subjects', 'school_subjects.id', 'class_subjects.subject_id')->orderBy('school_subjects.name', 'ASC')
                ->get();

        // Marks Registers' Table
        $data['Marks_Registers'] = MarksRegisters::where('marks_registers.class_id', $class_id)->where('session_id', $s_id)->where('term_id', $term_id)
            ->join('students', 'students.id', 'marks_registers.student_id')->join('school_classes', 'school_classes.id', 'marks_registers.class_id')
                ->join('school_sessions', 'school_sessions.id', 'marks_registers.session_id')
                    ->join('school_terms', 'school_terms.id', 'marks_registers.term_id')->get();

        $data['Result_positions'] = ResultPositions::select('student_id', 'obtained_marks', 'average', 'class_position')
                                        ->where('class_id', $class_id)->where('session_id', $s_id)->where('term_id', $term_id)
                                            ->get();
            
        return view('backend.Examination.results_summary_view', $data);

        } catch (Exception $e) {
            
            $notifications = array([
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ]);

            return redirect()->back()->with($notifications);
        }
    }
}

<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreCassScoresRequest;
use App\Http\Requests\UpdateCassScoresRequest;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CassScores;
use App\Models\SchoolClass;
use App\Models\SchoolTerm;
use App\Models\SchoolAssessments;
use App\Models\SchoolArms;
use App\Models\SchoolSessions;
use App\Models\SchoolSubjects;
use App\Models\MarksRegisters;

use Auth;


class CassScoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function upload()
    {
        $data['SchoolClasses'] = SchoolClass::all();
        $data['SchoolTerm'] = SchoolTerm::all();
        $data['SchoolSessions'] = SchoolSessions::all();        
        $data['SchoolSubjects'] = SchoolSubjects::all();
        $data['ClassArms'] = SchoolArms::all();

        return view('backend.Examination.request_form',$data);
        
    }

    public function uploadForm(Request $request)
    {    
        $data['SchoolClasses'] = SchoolClass::all();
        $data['SchoolTerm'] = SchoolTerm::all();
        $data['SchoolSessions'] = SchoolSessions::all();        
        $data['SchoolSubjects'] = SchoolSubjects::all();
        $data['ClassArms'] = SchoolArms::all();        
        $data['Current_Class'] = SchoolClass::find($request->class_id);
        $data['Class_Arm'] = SchoolArms::find($request->arm_id);        
        $data['subject'] = SchoolSubjects::find($request->subject_id);             
        $data['Students'] = StudentClass::join('students','students.students_id','student_classes.student_id')
            ->where('class_id','=',$request->class_id)
                ->where('school_arm_id', $request->arm_id)
                    ->where('academic_session_id', Active_Session()->id)
                        ->orderBy('roll_number', 'ASC')->get()->all();                    
        $data['Assessments'] = SchoolAssessments::where('class_id', '=', $request->class_id)->join('school_classes', 'school_classes.id', '=', 'school_assessments.class_id')
            ->orderBy('school_classes.id', 'ASC')->orderBy('school_assessments.id', 'ASC')
                ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')->get()->all();

        $notifications = [
            'message' => 'No Student was found in the selected class',
            'alert-type' => 'info'
        ];

        return isFound($data['Students']) ? view('backend.Examination.cass_entry_form', $data) : back()->with($notifications);
    }
    
    public function uploadScores(StoreCassScoresRequest $request)
    { 
        
        try {        
            // Marks Register        
            $records = [];
            foreach ($request->scores as $student => $scores) {                 
            $record = [];
            $record['total_scores'] = array_sum($scores);
            $record['subject_id'] = $request->subject;
            $record['class_id'] = $request->class_id;
            $record['class_arm_id'] = $request->class_arm_id;
            $record['academic_session_id'] = $request->current_session;
            $record['student_id'] = $student;
            $record['term_id'] = $request->current_term;            
            $records[] = $record;            
            }  

            $MarksRegisters = new MarksRegisters();
            $MarksRegisters->create($records);
            // End Marks Register
            

            // Students' Subject Position
            $Marks_Total = MarksRegisters::select('total_scores', 'id', 'subject_position')
                ->where('class_id', $request->class_id)
                    ->where('class_arm_id',$request->class_arm_id)
                        ->where('academic_session_id', $request->current_session)
                            ->where('term_id', $request->current_term)
                                ->where('subject_id', $request->subject)
                                    ->orderBy('total_scores', 'DESC')->get();
            $i = 0;
            $prev = 0;
            foreach ($Marks_Total as $id => $subject_total) {
                
                if($prev != $subject_total->total_scores)
                {
                    $prev = $subject_total->total_scores;                
                    $i++;
                }
                
                $position = MarksRegisters::find($subject_total->id);
                $position->subject_position = $i;
                $position->save();
            }
            
            // CASS Scores
            $rows = [];
            foreach($request->scores as $id => $marks) {                
                foreach($marks as $cass => $mark) {
                    $row = [];
                    $row['student_id'] = $id;
                    $row['subject_id'] = $request->subject;
                    $row['cass_type'] = $cass;
                    $row['scores'] = $mark ?? 0;
                    $row['class_id'] = $request->class_id;
                    $row['class_arm_id'] = $request->class_arm_id;
                    $row['term_id'] = $request->current_term;
                    $row['academic_session_id'] = $request->current_session;
                    $rows[] = $row;                    
                }
            }

            $cassScores = new CassScores();
            $cassScores->create($rows);
            // End CASS Scores                       

            $notifications = array([
                'message' => 'CASS Scores Uploaded Successfully.',
                'alert-type' => 'success'

            ]);
            return redirect()->back()->with($notifications);

        } catch(\Exception $e){

            $notifications = array([
                'message' => $e->getMessage(),
                'alert-type' => 'error'

            ]);

            return redirect()->back()->with($notifications);
        }
    }
    
    public function viewCass(Request  $request)
    {    
        
            
    }

    public function edit(CassScores $cassScores)
    {
        //
    }
    
    public function updateScores(UpdateCassScoresRequest $request, CassScores $cassScores)
    {
        //
    }
    
    public function destroy(CassScores $cassScores)
    {
        //
    }
}

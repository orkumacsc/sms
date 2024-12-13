<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCassScoresRequest;
use App\Http\Requests\UpdateCassScoresRequest;
use App\Models\StudentClass;
use DB;
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
use Response;


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
        if(!isScoresUploaded($request->class_id,$request->arm_id,$request->subject_id))
        {                  
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
        } else {
            $notifications = [
                'message' => 'Continous Assessment Scores already uploaded for the selected class & subject',
                'alert-type' => 'info'
            ];
            return back()->with($notifications);
        }
    }
    
    public function uploadScores(StoreCassScoresRequest $request)
    { 
        $CASS_scores = $request->scores;
        $students_positions = generatePositions($CASS_scores);
        
        try {             
            $rows = [];
            foreach($CASS_scores as $id => $marks) {                
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


            try{                
                $records = [];
                foreach ($CASS_scores as $student => $scores) {                 
                $record = [];
                $record['total_scores'] = array_sum($scores);
                $record['subject_position'] = $students_positions[$student];
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
            
                $notifications = [
                    'message' => 'Continuous Assessment Scores Successfully Uploaded!',
                    'alert-type' => 'success'
                ];

                return redirect('UploadResult')->with($notifications);
               
            } catch(\Exception $e){
                $notifications = array([
                    'message' => $e,
                    'alert-type' => 'error'
    
                ]);    
                return redirect()->back()->with($notifications); 
            }
        } catch(\Exception $e){
            $notifications = array([
                'message' => $e,
                'alert-type' => 'error'

            ]);

            return redirect()->back()->with($notifications);
        }
    }
    
    public function viewCass(Request  $request)
    {    
        
            
    }

    public function updateUploadedCass(Request $request)
    {
        if(isScoresUploaded($request->class_id,$request->arm_id,$request->subject_id))
        {
            $data['current_session'] = SchoolSessions::find($request->academic_session_id);
            $data['SchoolClasses'] = SchoolClass::find($request->class_id);
            $data['class_arms'] = SchoolArms::find($request->class_arm_id);
            $data['current_term'] = SchoolTerm::find($request->term_id);
            $data['subject'] = SchoolSubjects::find($request->subject_id);
            $data['Students'] = StudentClass::join('students','students.students_id','student_classes.student_id')
            ->where('class_id','=',$request->class_id)
            ->where('school_arm_id',Active_Term()->term_id)                
            ->where('academic_session_id',Active_Session()->id)
            ->orderBy('roll_number')
            ->get();

            $data['CASS_Scores'] = CassScores::select('student_id','cass_type','scores')            
                ->where('class_id','=',$request->class_id)
                    ->where('class_arm_id',$request->class_arm_id)
                        ->where('academic_session_id',Active_Session()->id)
                            ->where('term_id',Active_Term()->term_id)
                                ->where('subject_id',$request->subject_id)                                                                   
                                    ->get()->groupBy('cass_type');
                                    
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
                            view('backend.Examination.update_uploaded_cass', $data) :
                            back()->with($cass_notification)) :
                                back()->with($students_notification);  
        } 
    }
    
    public function updateScores(UpdateCassScoresRequest $request, CassScores $cassScores)
    {
        //
    }
    
    public function destroy(CassScores $cassScores)
    {
        //
    }

    public function downloadOffline(Request $request)
    {       
        $data['Students'] = StudentClass::select('students_id','admission_no','surname','firstname','middlename')
        ->join('students','students.students_id','student_classes.student_id')
            ->where('class_id','=',$request->class_id)
                ->where('school_arm_id', $request->arm_id)
                    ->where('academic_session_id', Active_Session()->id)
                        ->orderBy('roll_number', 'ASC')->get();

        $data['Assessments'] = SchoolAssessments::where('class_id', '=', $request->class_id)
        ->join('school_classes', 'school_classes.id', '=', 'school_assessments.class_id')
            ->orderBy('school_classes.id', 'ASC')->orderBy('school_assessments.id', 'ASC')
                ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')->get()->all();

        $class = SchoolClass::find($request->class_id)->toArray();
        $class_arm = SchoolArms::find($request->arm_id)->toArray();        
        $subject = SchoolSubjects::find($request->subject_id)->toArray();    
        
        $rows = [];
        $columns = [];

        foreach($data['Assessments'] as $assessement){
            $columns[] = $assessement->name;
        }

        $rows[] = ['Students_id','Admission No.', 'Full Name', ... $columns];
        
        foreach ($data['Students'] as $student) {
            $rows[] = [$student->students_id,$student->admission_no, trim("$student->surname $student->firstname $student->middlename")];                    
        }

        
        $filename = trim($class['classname'].$class_arm['arm_name'].$subject['subject_name']).'.csv';

        $openedFile = fopen($filename,mode: 'w');

        if(!$openedFile) {
            return back()->with();
        }

        foreach ($rows as $row) {
            fputcsv($openedFile, $row);
        }

        fclose($openedFile);

        return Response::download($filename);
    }

    public function offlineUpload(Request $request) 
    {
        if(!isScoresUploaded($request->class_id,$request->class_arm_id,$request->subject_id))
        {
            try {            
                $filename = $request->file('scoresheet');
                $students_info = array_map('str_getcsv',file($request->file('scoresheet')->getRealPath()))   ;
                array_shift($students_info);
                $cass = $students_info[0];
                                              
                $rows = [];
                    foreach($students_info as $marks) {
                        $i = 3;
                        while($i != count($marks)){
                            $row = [];
                            $row['student_id'] = $marks[0];
                            $row['subject_id'] = $request->subject_id;
                            $row['cass_type'] = $cass[$i];
                            $row['scores'] = $marks[$i] != null ? $marks[$i] : 0;
                            $row['class_id'] = $request->class_id;
                            $row['class_arm_id'] = $request->class_arm_id;
                            $row['term_id'] = Active_Term()->term_id;
                            $row['academic_session_id'] = Active_Session()->id;                            
                            $rows[] = $row;
                            $i++;
                        }
                    } 
                    $cassScores = new CassScores();
                    $cassScores->create($rows);                    
                    // End CASS Scores

                $records = [];
                foreach ($students_info as $student) {                 
                    $record = [];
                    $record['student_id'] = $student[0];
                    $record['total_scores'] = array_sum(array_slice($student,7));
                    $record['subject_id'] = $request->subject_id;
                    $record['class_id'] = $request->class_id;
                    $record['class_arm_id'] = $request->class_arm_id;
                    $record['academic_session_id'] = Active_Session()->id;            
                    $record['term_id'] = Active_Term()->term_id;            
                    $records[] = $record;            
                }   
                
                $MarksRegisters = new MarksRegisters();
                $MarksRegisters->create($records);
                // // End Marks Register

                // Students' Subject Position
                $Marks_Total = MarksRegisters::select('total_scores', 'id', 'subject_position')
                    ->where('class_id', $request->class_id)
                        ->where('class_arm_id',$request->class_arm_id)
                            ->where('academic_session_id', Active_Session()->id)
                                ->where('term_id', Active_Term()->term_id)
                                    ->where('subject_id', $request->subject_id)
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

                $notifications = [
                    'message' => 'Continuous Assessment Scores Successfully Uploaded!',
                    'alert-type' => 'success'
                ];
                return back()->with($notifications);
                
            } catch (\Exception $e) {
                $notifications = [
                    'message' => $e,
                    'alert-type' => 'success'
                ];
                return back()->with($notifications);
            }
        } else {
            $notifications = [
                'message' => 'Continous Assessment Scores already uploaded for the selected class & subject',
                'alert-type' => 'info'
            ];
            return back()->with($notifications);
        }
       
    }


    
}

<?php

namespace App\Http\Controllers\admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\SchoolTerm;
use App\Models\SchoolArms;
use App\Models\SchoolSessions;
use App\Models\Students;
use App\Models\CassScores;
use App\Models\SchoolAssessments;
use App\Models\MarksRegisters;
use App\Models\SchoolSubjects;
use App\Models\ResultPositions;

class ReportController extends Controller
{
    public function index()
    {        
        $data['SchoolTerm'] = SchoolTerm::all();
        $data['SchoolSessions'] = SchoolSessions::all();
        $data['SchoolClasses'] = SchoolClass::all();
        $data['ClassArms'] = SchoolArms::all();

        return view('backend.Reports.reports_index', $data);
    }    

    public function classResult(Request $request){
        $Class_id = $request->class_id;
        $Acad_Session_id = $request->acad_session;
        $data['SchoolTerm'] = SchoolTerm::all();
        $data['SchoolSessions'] = SchoolSessions::all();
        $data['SchoolClasses'] = SchoolClass::all();
        $data['ClassArms'] = SchoolArms::all();
        $data['Students'] = Students::orderBy('students.surname', 'ASC')                
            ->where('class','=',$Class_id)
                ->where('session_admitted','=',$Acad_Session_id)->get()->all();

        return view('backend.Reports.class_result', $data);
    }

    public function studentDossier(Request $request)
    {
        $session_id = $request->session_id;
        $term_id = $request->term_id;
        $class_id = $request->class_id;
        $classarm_id = $request->classarm_id;
        $student_id = $request->student_id;        
        
        $data['studentDetails'] = Students::join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')
        ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('genders', 'genders.id', '=', 'students.gender')
                ->where('students.id', '=', $student_id)->first();

        $data['Subjects'] = SchoolSubjects::all();

        $data['session'] = SchoolSessions::find($session_id);
        $data['class'] = SchoolClass::find($class_id);
        $data['term'] = SchoolTerm::find($term_id);

        $data['cassType'] = SchoolAssessments::join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')
            ->where('class_id', '=', $class_id)->get();

        $data['Scores'] = CassScores::select('subject_id', 'cass_type', 'scores')->where('session_id','=',$session_id)
                ->where('term_id','=',$term_id)
                    ->where('class_id','=',$class_id)
                        ->where('student_id','=',$student_id)->get()->groupBy('subject_id');   
                    
        $data['scoreSum'] = MarksRegisters::select('subject_id', 'total_scores', 'subject_position', 'class_highest', 'class_lowest')
            ->where('session_id','=',$session_id)
                ->where('term_id','=',$term_id)
                    ->where('class_id','=',$class_id)
                        ->where('student_id','=',$student_id)->get();
                    
        $data['Results'] = ResultPositions::select('student_id', 'obtained_marks', 'obtainable_marks', 'average', 'class_position', 'total_subjects_offered')
                ->where('session_id','=',$session_id)
                    ->where('term_id','=',$term_id)
                        ->where('class_id','=',$class_id)
                            ->where('student_id','=',$student_id)->get()->first();
// dd($data);
        return view('backend.Reports.students_dossier', $data);
    }
}

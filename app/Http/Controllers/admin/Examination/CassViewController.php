<?php

namespace App\Http\Controllers\admin\Examination;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\CassScores;
use App\Models\Students;
use App\Models\SchoolClass;
use App\Models\SchoolTerm;
use App\Models\SchoolAssessments;
use App\Models\SchoolArms;
use App\Models\SchoolSessions;
use App\Models\SchoolSubjects;
use App\Models\MarksRegisters;
use App\Models\ClassSubjects;
use App\Models\ResultPositions;

class CassViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data['SchoolClasses'] = SchoolClass::all();
        $data['SchoolTerm'] = SchoolTerm::all();
        $data['SchoolSessions'] = SchoolSessions::all();
        $data['SchoolSubjects'] = SchoolSubjects::all();
        $data['ClassArms'] = SchoolArms::all();

        return view('backend.Examination.cass_scores_index', $data);
    }

    public function broadsheet(Request $request)
    {
        try {
            $data['academic_session'] = SchoolSessions::find($request->academic_session_id);
            $data['school_class'] = SchoolClass::find($request->class_id);
            $data['class_arm'] = SchoolArms::find($request->class_arm_id);
            $data['term'] = SchoolTerm::find($request->term_id);
            $data['Students'] = StudentClass::join('students', 'students.students_id', 'student_classes.student_id')
                ->where('class_id', '=', $request->class_id)
                ->where('school_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->orderBy('roll_number')
                ->get();

            $data['subject_summary'] = MarksRegisters::select('student_id', 'total_scores', 'subject_id')                
                ->where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->where('term_id', $request->term_id)
                ->get();

            $data['computed_results'] = ResultPositions::select('student_id', 'average_score', 'obtained_marks', 'position_in_class')
                ->where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('session_id', $request->academic_session_id)
                ->where('term_id', $request->term_id)
                ->get();
            
            $data['subjects_in_class'] = ClassSubjects::where('class_id', $request->class_id)
                ->join('school_subjects', 'school_subjects.id', 'class_subjects.subject_id')
                ->orderBy('school_subjects.subject_name', 'ASC')
                ->get();

            $cass_notification = [
                'message' => 'Result has not been computed for the selected class.',
                'alert-type' => 'info'
            ];
            $students_notification = [
                'message' => 'There is no student in the selected class.',
                'alert-type' => 'info'
            ];

            return isFound($data['Students']) ?
                (isFound($data['computed_results']) && $data['subject_summary'] ?
                    view('Examination_Officer.broadsheet', $data) :
                    back()->with($cass_notification)) :
                back()->with($students_notification);

        } catch (\Exception $e) {

            $notifications = array(
                [
                    'message' => 'Error in generating broadsheet. Contact Support.',
                    'alert-type' => 'error'
                ]
            );

            return redirect()->back()->with($notifications);
        }
    }


    public function viewCass(Request $request)
    {
        try {
            $data['academic_session'] = SchoolSessions::find($request->academic_session_id);
            $data['school_class'] = SchoolClass::find($request->class_id);
            $data['class_arm'] = SchoolArms::find($request->class_arm_id);
            $data['term'] = SchoolTerm::find($request->term_id);
            $data['subject'] = SchoolSubjects::find($request->subject_id);

            $data['Students'] = StudentClass::join('students', 'students.students_id', 'student_classes.student_id')
                ->where('class_id', '=', $request->class_id)
                ->where('school_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->orderBy('roll_number')
                ->get();

            $data['CASS_Scores'] = CassScores::select('student_id', 'cass_type', 'scores')
                ->where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->where('term_id', $request->term_id)
                ->where('subject_id', $request->subject_id)
                ->get()->groupBy('cass_type');

            $data['Marks_Registers'] = MarksRegisters::where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->where('term_id', $request->term_id)
                ->where('subject_id', $request->subject_id)
                ->get()->all();

            $data['Assessments'] = SchoolAssessments::where('class_id', '=', $request->class_id)
                ->join('school_classes', 'school_classes.id', '=', 'school_assessments.class_id')
                ->orderBy('school_classes.id', 'ASC')->orderBy('school_assessments.id', 'ASC')
                ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')
                ->get();

            $cass_notification = [
                'message' => 'Continuous Assessment Scores has not been uploaded for the selected Class',
                'alert-type' => 'info'
            ];
            $students_notification = [
                'message' => 'There is no student in the selected class.',
                'alert-type' => 'info'
            ];

            return isFound($data['Students']) ?
                (isFound($data['CASS_Scores']) ?
                    view('backend.Examination.view_cass_scores', $data) :
                    back()->with($cass_notification)) :
                back()->with($students_notification);

        } catch (\Exception $e) {

            $notifications = array(
                [
                    'message' => 'Error in Uploaded Subject Report. Contact Support.',
                    'alert-type' => 'error'
                ]
            );

            return redirect()->back()->with($notifications);
        }
    }

}

<?php

namespace App\Http\Controllers\admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\ClassSubjects;
use App\Models\StudentClass;
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
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function classReport(Request $request)
    {
        try {
            $data['academic_session'] = SchoolSessions::find($request->academic_session_id);
            $data['school_class'] = SchoolClass::find($request->class_id);
            $data['class_arm'] = SchoolArms::find($request->class_arm_id);
            $data['term'] = SchoolTerm::find($request->term_id);
            $data['students'] = StudentClass::select('admission_no', 'student_classes.id as id', 'surname', 'firstname', 'middlename', 'gendername', 'name', 'date_of_birth')
                ->join('students', 'students.students_id', 'student_classes.student_id')
                ->join('genders', 'genders.id', '=', 'students.gender')
                ->join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')
                ->where('class_id', '=', $request->class_id)
                ->where('school_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->orderBy('roll_number')
                ->get();

            $data['assessments'] = SchoolAssessments::where('class_id', '=', $request->class_id)
                ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')
                ->orderBy('school_assessments.id', 'ASC')
                ->get();

            $data['subjects_in_class'] = ClassSubjects::where('class_id', $request->class_id)
                ->join('school_subjects', 'school_subjects.id', 'class_subjects.subject_id')
                ->orderBy('school_subjects.subject_name', 'ASC')
                ->get();

            $data['students_cass'] = CassScores::select('student_id', 'cass_type', 'scores', 'subject_id')
                ->where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->where('term_id', $request->term_id)
                ->get()->groupBy('subject_id');

            $data['subject_summary'] = MarksRegisters::select('student_id', 'total_scores', 'subject_id', 'subject_position')
                ->where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->where('term_id', $request->term_id)
                ->get()->groupBy('subject_id');

            $data['computed_results'] = ResultPositions::where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('session_id', $request->academic_session_id)
                ->where('term_id', $request->term_id)
                ->get();

            $cass_notification = [
                'message' => 'Result has not been computed for the selected class.',
                'alert-type' => 'info'
            ];
            
            $students_notification = [
                'message' => 'There is no student in the selected class.',
                'alert-type' => 'info'
            ];

            return isFound($data['students']) ?
                (isFound($data['computed_results']) ?
                    view('Examination_Officer.class_report_cards', $data) :
                    back()->with($cass_notification)) :
                back()->with($students_notification);

        } catch (\Exception $e) {

            $notifications = array(
                [
                    'message' => 'Error in Processing Class Result! Contact Support.',
                    'alert-type' => 'error'
                ]
            );

            return redirect()->back()->with($notifications);
        }
    }

    public function studentReport(Request $request)
    {
        try {
            $data['academic_session'] = SchoolSessions::find($request->academic_session_id);
            $data['school_class'] = SchoolClass::find($request->class_id);
            $data['class_arm'] = SchoolArms::find($request->class_arm_id);
            $data['term'] = SchoolTerm::find($request->term_id);
            $data['students'] = StudentClass::join('students', 'students.students_id', 'student_classes.student_id')
                ->join('genders', 'genders.id', '=', 'students.gender')
                ->join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')
                ->where('class_id', '=', $request->class_id)
                ->where('school_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->orderBy('roll_number')
                ->find($request->student_id, ['admission_no', 'student_classes.id as id', 'surname', 'firstname', 'middlename', 'gendername', 'name', 'date_of_birth']);

            $data['assessments'] = SchoolAssessments::where('class_id', '=', $request->class_id)
                ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')
                ->orderBy('school_assessments.id', 'ASC')
                ->get();

            $data['subjects_in_class'] = ClassSubjects::where('class_id', $request->class_id)
                ->join('school_subjects', 'school_subjects.id', 'class_subjects.subject_id')
                ->orderBy('school_subjects.subject_name', 'ASC')
                ->get();

            $data['students_cass'] = CassScores::select('student_id', 'cass_type', 'scores', 'subject_id')
                ->where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->where('term_id', $request->term_id)
                ->where('student_id', $request->student_id)
                ->get();

            $data['subject_summary'] = MarksRegisters::select('student_id', 'total_scores', 'subject_id', 'subject_position')
                ->where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->where('term_id', $request->term_id)
                ->where('student_id', $request->student_id)
                ->get();

            $data['computed_results'] = ResultPositions::where('class_arm_id', $request->class_arm_id)
                ->where('session_id', $request->academic_session_id)
                ->where('term_id', $request->term_id)
                ->where('class_id', '=', $request->class_id)
                ->where('student_id', $request->student_id)
                ->get()->first();

            $notification = [
                'message' => 'No result found for this student!',
                'alert-type' => 'info'
            ];
            
            return
                $data['computed_results'] && $data['subject_summary'] && $data['students_cass'] ?
                view('Examination_Officer.students_report_card', $data) :
                back()->with($notification);

        } catch (\Exception $e) {

            $notifications = array(
                [
                    'message' => 'Error in Processing Student Result! Contact Support.',
                    'alert-type' => 'error'
                ]
            );

            return redirect()->back()->with($notifications);
        }
    }

}

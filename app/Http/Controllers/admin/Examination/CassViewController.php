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
            $class_id = SchoolClass::find($request->class_id);
            $class_arm_id = SchoolArms::find($request->class_arm_id);
            $department_id = strpos($class_id->classname, 'BASIC') !== false ? 4 :
                (strpos($class_arm_id->arm_name, 'A') !== false ? 1 :
                    (strpos($class_arm_id->arm_name, 'B') !== false ? 2 : 3));

            $data['academic_session'] = SchoolSessions::find($request->academic_session_id);
            $data['term'] = SchoolTerm::find($request->term_id);
            $data['school_class'] = $class_id;
            $data['class_arm'] = $class_arm_id;

            $data['Students'] = StudentClass::join('students', 'students.students_id', 'student_classes.student_id')
                ->where('class_id', '=', $request->class_id)
                ->where('school_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->orderBy('roll_number')
                ->get();

            /* If no student is found in the class */
            $notifications = [
                'message' => 'There is no student in the selected class.',
                'alert-type' => 'info'
            ];

            if (!isFound($data['Students']))
                return back()->with($notifications);

            $data['subjects_in_class'] = ClassSubjects::where('class_id', $request->class_id)
                ->where('department_id', $department_id)
                ->join('school_subjects', 'school_subjects.id', 'class_subjects.subject_id')
                ->orderBy('school_subjects.subject_name', 'ASC')
                ->get();

                $notifications = [
                    'message' => 'There is no subject assigned to the selected class.',
                    'alert-type' => 'info'
                ];
    
                if (!isFound($data['subjects_in_class']))
                    return back()->with($notifications);
            $data['subject_summary'] = MarksRegisters::select('student_id', 'total_scores', 'subject_id')
                ->where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->where('term_id', $request->term_id)
                ->get()->groupBy('student_id')->toArray();


            $student_obtained_marks = (function ($data) {
                $students_marks = [];
                foreach ($data as $student_id => $students) {
                    $obtained_marks = 0;
                    foreach ($students as $student) {
                        $obtained_marks += $student['total_scores'];
                    }
                    $students_marks[$student_id] = $obtained_marks;
                }
                arsort($students_marks);

                return $students_marks;
            })($data['subject_summary']);

            $positions = (function ($data) {
                $students_positions = [];
                $i = 0;
                $prev = 0;
                foreach ($data as $student_id => $subject_total) {
                    if ($prev != $subject_total)
                    {
                        $prev = $subject_total;
                        $i++;
                    }
                    $students_positions[$student_id] = $i;
                }
                return $students_positions;
            })($student_obtained_marks);

            $data['class_average'] = (float) number_format((array_sum($student_obtained_marks) /
                count($student_obtained_marks)) /
                count($data['subjects_in_class']), 2);

            $rows = [];
            foreach ($data['subject_summary'] as $student_id => $Student_result) {
                $row = [];
                $row['student_id'] = $student_id;
                $row['obtained_marks'] = $student_obtained_marks[$student_id];
                $row['total_subjects_offered'] = count($Student_result);
                $row['obtainable_marks'] = count($data['subjects_in_class']) * 100;
                $row['average_score'] = (float) number_format(($row['obtained_marks'] * 100) / $row['obtainable_marks'], 2) ?? 0.00;
                $row['position_in_class'] = $positions[$student_id];
                $rows[] = $row;
            }
            $data['computed_results'] = $rows;

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

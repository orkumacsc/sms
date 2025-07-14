<?php

namespace App\Http\Controllers\admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\ClassSubjects;
use App\Models\StudentClass;
use DB;
use Illuminate\Database\Eloquent\Collection;
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
use App\Models\SchoolClassInfo;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function classReport(Request $request)
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
            $data['term_end'] = Active_Term()->term_end;
            $data['next_term_start'] = Active_Term()->next_term_start;

            $data['students'] = StudentClass::select('admission_no', 'student_classes.id as id', 'surname', 'firstname', 'middlename', 'gendername', 'name', 'date_of_birth', 'passport')
                ->join('students', 'students.students_id', 'student_classes.student_id')
                ->join('genders', 'genders.id', '=', 'students.gender')
                ->join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')
                ->where('class_id', '=', $request->class_id)
                ->where('school_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->orderBy('roll_number')
                ->get()->toArray();

            /* If no student is found in the class */
            $notifications = [
                'message' => 'There is no student in the selected class.',
                'alert-type' => 'info'
            ];

            if (!isFound($data['students']))
                return back()->with($notifications);

            $data['assessments'] = SchoolAssessments::where('class_id', '=', $request->class_id)
                ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')
                ->orderBy('school_assessments.id', 'ASC')
                ->get()->toArray();

            $data['subjects_in_class'] = ClassSubjects::where('class_id', $request->class_id)
                ->where('department_id', $department_id)
                ->join('school_subjects', 'school_subjects.id', 'class_subjects.subject_id')
                ->orderBy('school_subjects.subject_name', 'ASC')
                ->get()->toArray();

            $notifications = [
                'message' => 'No subject assigned to the selected class the selected class.',
                'alert-type' => 'info'
            ];

            if (!isFound($data['subjects_in_class']))
                return redirect()->route('school_subjects')->with($notifications);

            $data['students_cass'] = CassScores::select('student_id', 'cass_type', 'scores', 'subject_id')
                ->where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->where('term_id', $request->term_id)
                ->get()->groupBy('student_id')->toArray();

            $data['subject_summary'] = MarksRegisters::select('student_id', 'total_scores', 'subject_id', 'subject_position')
                ->where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->where('term_id', $request->term_id)
                ->get()->groupBy('student_id')->toArray();

            /* If no student is data is found in subject_summary */
            $notifications = [
                'message' => 'Continuous Assessment Scores has not been uploaded for the selected class.',
                'alert-type' => 'info'
            ];

            if (!isFound($data['subject_summary']))
                return back()->with($notifications);

            $student_obtained_marks = calculateObtainedMarks($data['subject_summary']);
            $positions = calculatePositions($student_obtained_marks);

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

            return view('Examination_Officer.class_report_cards', $data);

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
            $class_id = SchoolClass::find($request->class_id);
            $class_arm_id = SchoolArms::find($request->class_arm_id);
            $department_id = strpos($class_id->classname, 'BASIC') !== false ? 4 :
                (strpos($class_arm_id->arm_name, 'A') !== false ? 1 :
                    (strpos($class_arm_id->arm_name, 'B') !== false ? 2 : 3));


            $data['academic_session'] = SchoolSessions::find($request->academic_session_id);
            $data['term'] = SchoolTerm::find($request->term_id);
            $data['school_class'] = $class_id;
            $data['class_arm'] = $class_arm_id;
            $data['term_end'] = Active_Term()->term_end;
            $data['next_term_start'] = Active_Term()->next_term_start;

            $students = StudentClass::join('students', 'students.students_id', 'student_classes.student_id')
                ->join('genders', 'genders.id', '=', 'students.gender')
                ->join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')
                ->where('class_id', '=', $request->class_id)
                ->where('school_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->orderBy('roll_number')
                ->find($request->student_id, ['admission_no', 'student_classes.id as id', 'surname', 'firstname', 'middlename', 'gendername', 'name', 'date_of_birth', 'passport']);

            $assessments = SchoolAssessments::where('class_id', '=', $request->class_id)
                ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')
                ->orderBy('school_assessments.id', 'ASC')
                ->get();

            $subjects_in_class = ClassSubjects::where('class_id', $request->class_id)
                ->where('department_id', $department_id)
                ->join('school_subjects', 'school_subjects.id', 'class_subjects.subject_id')
                ->orderBy('school_subjects.subject_name', 'ASC')
                ->get();

            $notifications = [
                'message' => 'No subject assigned to the selected class the selected class.',
                'alert-type' => 'info'
            ];

            if (!isFound($subjects_in_class))
                return redirect()->route('school_subjects')->with($notifications);

            $students_cass = CassScores::select('student_id', 'cass_type', 'scores', 'subject_id')
                ->where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->where('term_id', $request->term_id)
                ->get()->groupBy('student_id')->toArray();

            $subject_summary = MarksRegisters::select('student_id', 'total_scores', 'subject_id', 'subject_position')
                ->where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->where('term_id', $request->term_id)
                ->get()->groupBy('student_id')->toArray();

            /* If no student is data is found in subject_summary */
            $notifications = [
                'message' => 'No result found for this student.',
                'alert-type' => 'info'
            ];

            if (!isFound($subject_summary))
                return back()->with($notifications);

            $student_obtained_marks = calculateObtainedMarks($subject_summary);
            $positions = calculatePositions($student_obtained_marks);
            $max_subjects_allowed = getTotalSubjects($class_id->id, $subjects_in_class);
            $class_average = (float) number_format((array_sum($student_obtained_marks) /
                count($student_obtained_marks)) /
                $max_subjects_allowed, 2);            

            $rows = [];
            foreach ($subject_summary as $student_id => $Student_result) {
                $row = [];
                $row['student_id'] = $student_id;
                $row['obtained_marks'] = $student_obtained_marks[$student_id];
                $row['total_subjects_offered'] = $max_subjects_allowed;
                $row['obtainable_marks'] =  $max_subjects_allowed * 100;
                $row['average_score'] = (float) number_format(($row['obtained_marks'] * 100) / $row['obtainable_marks'], 2) ?? 0.00;
                $row['position_in_class'] = $positions[$student_id];
                $rows[$student_id] = $row;
            }
            $computed_results = $rows;

            $data['computed_results'] = $computed_results[$request->student_id];
            $data['subject_summary'] = $subject_summary[$request->student_id];
            $data['students_cass'] = $students_cass[$request->student_id];
            $data['students'] = $students;
            $data['assessments'] = $assessments;
            $data['subjects_in_class'] = $subjects_in_class;
            $data['max_subjects_allowed'] = $max_subjects_allowed;
            $data['class_average'] = $class_average;

            return view('Examination_Officer.students_report_card', $data);

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

}

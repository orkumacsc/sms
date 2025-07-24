<?php

namespace App\Http\Controllers;

use App\Models\CassScores;
use App\Models\ClassSubjects;
use App\Models\MarksRegisters;
use App\Models\SchoolArms;
use App\Models\SchoolAssessments;
use App\Models\SchoolClass;
use App\Models\SchoolSessions;
use App\Models\SchoolTerm;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Validator;

class CheckResultController extends Controller
{
    public function index()
    {
        $data['school_classes'] = SchoolClass::all();
        $data['school_arms'] = SchoolArms::all();
        $data['school_academic_sessions'] = SchoolSessions::all();
        $data['school_terms'] = SchoolTerm::all();

        return view('Students.check_result', $data);
    }

    public function processResult(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['admission_number' => 'required|max:255|']
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        array_walk_recursive($input, function (&$input) {
            $input = strip_tags($input);
            $input = trim($input);
            $input = str_replace(' ', '', $input);
        });

        $result_type = (int) $input['result_type'];

        if ($result_type === 1) {

            try {
                $students = StudentClass::select('admission_no', 'student_classes.id as id', 'surname', 'firstname', 'middlename', 'gendername', 'name', 'date_of_birth', 'passport', 'class_id', 'school_arm_id')
                    ->join('students', 'students.students_id', 'student_classes.student_id')
                    ->join('genders', 'genders.id', '=', 'students.gender')
                    ->join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')
                    ->where('student_id', getStudentId($input['admission_number']))
                    ->get()->first();

                if (!$students)
                    return view('Students.no_records', $input);

                $class_id = $students->class_id;
                $class_arm_id = $students->school_arm_id;
                $class = SchoolClass::find($class_id);
                $class_arm = SchoolArms::find($class_arm_id);
                $department_id = getDepartmentId($class->classname, $class_arm->arm_name);
                $academic_session = SchoolSessions::find($input['academic_session_id']);
                $term = SchoolTerm::find($input['term_id']);

                $students_cass = CassScores::select('student_id', 'cass_type', 'scores', 'subject_id')
                    ->where('class_id', '=', $class_id)
                    ->where('class_arm_id', $class_arm_id)
                    ->where('academic_session_id', $input['academic_session_id'])
                    ->where('term_id', $input['term_id'])
                    ->get()->groupBy('student_id')->toArray();

                $subject_summary = MarksRegisters::select('student_id', 'total_scores', 'subject_id', 'subject_position')
                    ->where('class_id', '=', $class_id)
                    ->where('class_arm_id', $class_arm_id)
                    ->where('academic_session_id', $input['academic_session_id'])
                    ->where('term_id', $input['term_id'])
                    ->get()->groupBy('student_id')->toArray();

                if (!($students_cass && $subject_summary)) {

                    $check_back['students'] = $students;
                    $check_back['academic_session'] = $academic_session->name;
                    $check_back['term'] = $term->name;

                    return view('Students.check_back', $check_back);
                }

                $subjects_in_class = ClassSubjects::where('class_id', $class_id)
                    ->where('department_id', $department_id)
                    ->join('school_subjects', 'school_subjects.id', 'class_subjects.subject_id')
                    ->orderBy('school_subjects.subject_name', 'ASC')
                    ->get();

                $assessments = SchoolAssessments::where('class_id', '=', $class_id)
                    ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')
                    ->orderBy('school_assessments.id', 'ASC')
                    ->get();

                $student_obtained_marks = calculateObtainedMarks($subject_summary);
                $positions = calculatePositions($student_obtained_marks);
                $max_subjects_allowed = getTotalSubjects($class_id, $subjects_in_class);
                $computed_results = computeResults($subject_summary, $student_obtained_marks, $positions, $max_subjects_allowed);
                $class_average = getClassAverage($student_obtained_marks, $max_subjects_allowed);
                $students_id = $students->id;

                $data['academic_session'] = $academic_session;
                $data['school_class'] = $class;
                $data['class_arm'] = $class_arm;
                $data['term'] = $term;
                $data['computed_results'] = $computed_results[$students_id];
                $data['subject_summary'] = $subject_summary[$students_id];
                $data['students_cass'] = $students_cass[$students_id];
                $data['students'] = $students;
                $data['assessments'] = $assessments;
                $data['subjects_in_class'] = $subjects_in_class;
                $data['max_subjects_allowed'] = $max_subjects_allowed;
                $data['class_average'] = $class_average;
                $data['class_size'] = count($computed_results);

                unset($request);
                return view('Students.termly_report_card', $data);

            } catch (\Exception $e) {
                $notifications = array(
                    [
                        'message' => 'Error in Processing Class Result! Contact Support.',
                        'alert-type' => 'error'
                    ]
                );

                return redirect()->back()->with($notifications);
            }
        } elseif ($result_type === 2) {
            try {
                $students = StudentClass::select('student_id', 'admission_no', 'student_classes.id as id', 'surname', 'firstname', 'middlename', 'gendername', 'name', 'date_of_birth', 'passport', 'class_id', 'school_arm_id')
                    ->join('students', 'students.students_id', 'student_classes.student_id')
                    ->join('genders', 'genders.id', '=', 'students.gender')
                    ->join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')
                    ->where('student_id', getStudentId($input['admission_number']))
                    ->get()->first();

                if (!$students)
                    return view('Students.no_records', $input);

                $class_id = $students->class_id;
                $class_arm_id = $students->school_arm_id;
                $class = SchoolClass::find($class_id);
                $class_arm = SchoolArms::find($class_arm_id);
                $department_id = getDepartmentId($class->classname, $class_arm->arm_name);
                $academic_session = SchoolSessions::find($input['academic_session_id']);
                $terms = SchoolTerm::get()->all();

                $subject_summary = MarksRegisters::select('student_id', 'total_scores', 'subject_id', 'subject_position', 'term_id')
                    ->where('class_id', '=', $class_id)
                    ->where('class_arm_id', $class_arm_id)
                    ->where('academic_session_id', $input['academic_session_id'])
                    ->where('total_scores', '>', 0)
                    ->get()->groupBy('student_id')
                    ->toArray();


                if (!$subject_summary) {
                    $check_back['students'] = $students;
                    $check_back['academic_session'] = $academic_session->name;

                    return view('Students.check_back', $check_back);
                }

                $subjects_in_class = ClassSubjects::where('class_id', $class_id)
                    ->where('department_id', $department_id)
                    ->join('school_subjects', 'school_subjects.id', 'class_subjects.subject_id')
                    ->orderBy('school_subjects.subject_name', 'ASC')
                    ->get();

                $student_obtained_marks = calculateObtainedMarks($subject_summary);
                $positions = calculatePositions($student_obtained_marks);
                $max_subjects_allowed = getTotalSubjects($class_id, $subjects_in_class);
                $computed_results = computeResults($subject_summary, $student_obtained_marks, $positions, $max_subjects_allowed, $result_type);
                $class_average = getClassAverage($student_obtained_marks, $max_subjects_allowed, $result_type);
                $annual_subjects_summary = calculateAnnualSubjectsSummary($subject_summary);
                $annual_subject_positions = annualSubjectGrading($annual_subjects_summary, 2);
                $annual_subject_averages = annualSubjectGrading($annual_subjects_summary);
                $annual_subject_high_low = calculateSubjectHighLow($annual_subjects_summary);
                $students_id = $students->id;


                $data['academic_session'] = $academic_session;
                $data['school_class'] = $class;
                $data['class_arm'] = $class_arm;
                $data['computed_results'] = $computed_results[$students_id];
                $data['annual_subject_average'] = $annual_subject_averages[$students_id];
                $data['annual_subject_position'] = $annual_subject_positions[$students_id];
                $data['annual_subject_high_low'] = $annual_subject_high_low;
                $data['subject_summary'] = $subject_summary[$students_id];
                $data['annual_subjects_summary'] = $annual_subjects_summary[$students_id];
                $data['students'] = $students;
                $data['terms'] = $terms;
                $data['subjects_in_class'] = $subjects_in_class;
                $data['max_subjects_allowed'] = $max_subjects_allowed;
                $data['class_average'] = $class_average;
                $data['class_size'] = count($computed_results);

                unset($request);
                return view('Students.annual_report_card', $data);

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
}

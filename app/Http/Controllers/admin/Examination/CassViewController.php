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

    public function annualBroadsheet(Request $request)
    {
        if (!$request->has(['class_id', 'class_arm_id', 'academic_session_id'])) {
            return redirect()->back()->with([
                'message' => 'Please select a class, arm, and academic session.',
                'alert-type' => 'warning'
            ]);
        }

        $class_id = $request->class_id;
        $arm_id = $request->class_arm_id;
        $session_id = $request->academic_session_id;

        $school_class = SchoolClass::findOrFail($class_id);
        $class_arm = SchoolArms::findOrFail($arm_id);
        $academic_session = SchoolSessions::findOrFail($session_id);
        $terms = SchoolTerm::all();

        $department_id = $this->getDepartmentId($school_class, $class_arm);

        $subjects_in_class = $this->getSubjectsInClass($class_id, $department_id);

        if ($subjects_in_class->isEmpty()) {
            return redirect()->back()->with([
                'message' => 'No subjects found for the selected class.',
                'alert-type' => 'info'
            ]);
        }

        $students = $this->getStudentsInClass($class_id, $arm_id, $session_id);

        if ($students->isEmpty()) {
            return redirect()->back()->with([
                'message' => 'No students found for the selected class.',
                'alert-type' => 'info'
            ]);
        }

        $studentsViaStudentClass = StudentClass::where('class_id', $class_id)
            ->where('school_arm_id', $arm_id)
            ->where('academic_session_id', $session_id)
            ->get();

        $subject_summary = $this->getSubjectSummary($class_id, $arm_id, $session_id, $studentsViaStudentClass);

        $subject_summary = $this->initializeSubjectSummary($subject_summary, $students, $subjects_in_class, $terms);

        $num_distinct_terms = $this->getNumDistinctTerms($subject_summary);

        [$annual_subjects_summary, $annual_subject_average] = $this->getAnnualSubjectSummaries($subject_summary);

        $annual_subject_high_low = $this->getAnnualSubjectHighLow($subjects_in_class, $students, $annual_subjects_summary, $num_distinct_terms);

        $computed_results = $this->getComputedResults($students, $subjects_in_class, $annual_subjects_summary, $terms, $num_distinct_terms);

        $computed_results = $this->assignPositions($computed_results);

        return view('Examination_Officer.annual_broadsheet', [
            'academic_session' => $academic_session,
            'school_class' => $school_class,
            'class_arm' => $class_arm,
            'terms' => $terms,
            'subjects_in_class' => $subjects_in_class,
            'students' => $students,
            'subject_summary' => $subject_summary,
            'annual_subjects_summary' => $annual_subjects_summary,
            'annual_subject_average' => $annual_subject_average,
            'annual_subject_high_low' => $annual_subject_high_low,
            'computed_results' => $computed_results,
        ]);
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

    private function getDepartmentId($school_class, $class_arm)
    {
        return strpos($school_class->classname, 'BASIC') !== false ? 4 :
            (strpos($class_arm->arm_name, 'A') !== false ? 1 :
                (strpos($class_arm->arm_name, 'B') !== false ? 2 : 3));
    }

    private function getSubjectsInClass($class_id, $department_id)
    {
        return SchoolSubjects::whereHas('SchoolClasses', function ($query) use ($class_id, $department_id) {
            $query->where('class_id', $class_id)
                ->where('department_id', $department_id);
        })->get();
    }

    private function getStudentsInClass($class_id, $arm_id, $session_id)
    {
        return Students::whereHas('SchoolClasses', function ($query) use ($class_id, $arm_id, $session_id) {
            $query->where('class_id', $class_id)
                ->where('school_arm_id', $arm_id)
                ->where('academic_session_id', $session_id);
        })
            ->orderBy('surname')
            ->get()
            ->map(fn($student) => [
                'id' => $student->students_id,
                'admission_no' => $student->admission_no,
                'surname' => $student->surname,
                'firstname' => $student->firstname,
                'middlename' => $student->middlename,
            ]);
    }

    private function getSubjectSummary($class_id, $arm_id, $session_id, $studentsViaStudentClass)
    {
        $subject_summary = [];
        $marks = MarksRegisters::where('class_id', $class_id)
            ->where('class_arm_id', $arm_id)
            ->where('academic_session_id', $session_id)
            ->get();

        foreach ($marks as $mark) {
            $subject_summary[$mark->student_id][$mark->subject_id][$mark->term_id] = $mark->total_scores;
        }

        $updated_subject_summary = [];
        foreach ($subject_summary as $student_id_key => $subjects) {
            foreach ($studentsViaStudentClass as $student) {
                $sid = $student->id;
                if ($student_id_key == $sid) {
                    $updated_subject_summary[$student->student_id] = $subjects;
                    break;
                }
            }
        }
        return $updated_subject_summary;
    }

    private function initializeSubjectSummary($subject_summary, $students, $subjects_in_class, $terms)
    {
        foreach ($students as $student) {
            $student_id = $student['id'];
            foreach ($subjects_in_class as $subject) {
                $subject_id = $subject->id;
                if (!isset($subject_summary[$student_id][$subject_id])) {
                    $subject_summary[$student_id][$subject_id] = [];
                }
                foreach ($terms as $term) {
                    if (!isset($subject_summary[$student_id][$subject_id][$term->id])) {
                        $subject_summary[$student_id][$subject_id][$term->id] = 0;
                    }
                }
            }
        }
        return $subject_summary;
    }

    private function getNumDistinctTerms($subject_summary)
    {
        $num_distinct_terms = 0;
        if (!empty($subject_summary)) {
            foreach ($subject_summary as $student_subjects) {
                foreach ($student_subjects as $subject_terms) {
                    $num_distinct_terms = count($subject_terms);
                    break 2;
                }
            }
        }
        return $num_distinct_terms;
    }

    private function getAnnualSubjectSummaries($subject_summary)
    {
        $annual_subjects_summary = [];
        $annual_subject_average = [];
        foreach ($subject_summary as $student_id => $subjects) {
            foreach ($subjects as $subject_id => $terms_scores) {
                $total = array_sum($terms_scores);
                $annual_subjects_summary[$student_id][$subject_id] = $total;
                $annual_subject_average[$student_id][$subject_id] = round($total / max(count($terms_scores), 1), 2);
            }
        }
        return [$annual_subjects_summary, $annual_subject_average];
    }

    private function getAnnualSubjectHighLow($subjects_in_class, $students, $annual_subjects_summary, $num_distinct_terms)
    {
        $annual_subject_high_low = [];
        foreach ($subjects_in_class as $subject) {
            $subject_id = $subject->id;
            $totals = [];
            foreach ($students as $student) {
                if (isset($annual_subjects_summary[$student['id']][$subject_id])) {
                    $totals[] = $annual_subjects_summary[$student['id']][$subject_id];
                }
            }
            $annual_subject_high_low[$subject_id] = [
                'average' => (count($totals) && $num_distinct_terms > 0) ? round(array_sum($totals) / (count($totals) * $num_distinct_terms), 2) : '-',
                'highest' => count($totals) ? max($totals) : '-',
                'lowest' => count($totals) ? min($totals) : '-',
            ];
        }
        return $annual_subject_high_low;
    }

    private function getComputedResults($students, $subjects_in_class, $annual_subjects_summary, $terms, $num_distinct_terms)
    {
        $computed_results = [];
        foreach ($students as $student) {
            $student_id = $student['id'];
            $obtained_marks = 0;
            $total_subjects_offered = 0;
            $obtainable_marks = 0;

            foreach ($subjects_in_class as $subject) {
                $subject_id = $subject->id;
                if (isset($annual_subjects_summary[$student_id][$subject_id])) {
                    $obtained_marks += $annual_subjects_summary[$student_id][$subject_id];
                    $total_subjects_offered++;
                    $obtainable_marks += count($terms) * 100; // assuming 100 per term
                }
            }

            $average_score = ($total_subjects_offered && $num_distinct_terms > 0) ? round($obtained_marks / ($total_subjects_offered * $num_distinct_terms), 2) : 0;

            $computed_results[$student_id] = [
                'student_id' => $student_id,
                'obtained_marks' => $obtained_marks,
                'total_subjects_offered' => $total_subjects_offered,
                'obtainable_marks' => $obtainable_marks,
                'average_score' => $average_score
            ];
        }
        return $computed_results;
    }

    private function assignPositions($computed_results)
    {
        $sorted = $computed_results;
        usort($sorted, function ($a, $b) {
            return $b['average_score'] <=> $a['average_score'];
        });
        foreach ($sorted as $pos => $result) {
            $computed_results[$result['student_id']]['position_in_class'] = $pos + 1;
        }
        return $computed_results;
    }
           
    
}

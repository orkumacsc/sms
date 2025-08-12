<?php

namespace App\Http\Controllers\admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\Assessment_Types;
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

    /**
     * Determine department id based on class and arm.
     *
     * @param  object  $school_class
     * @param  object  $class_arm
     * @return int
     */

    private function determineDepartmentId($school_class, $class_arm)
    {
        if (strpos($school_class->classname, 'BASIC') !== false) {
            return 4;
        } elseif (strpos($class_arm->arm_name, 'A') !== false) {
            return 1;
        } elseif (strpos($class_arm->arm_name, 'B') !== false) {
            return 2;
        } else {
            return 3;
        }
    }

    /**
     * Compute the average score for a class.
     *
     * @param mixed $computed_results
     * @return float|int
     */    
    private function computeClassAverage($computed_results)
    {
        return count($computed_results)
            ? round(array_sum(array_column($computed_results, 'average_score')) / count($computed_results), 2)
            : 0;
    }

    /**
     * Get the students in a specific class and arm.
     *
     * @param int $class_id
     * @param int $arm_id
     * @param int $session_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getStudentsInClass($class_id, $arm_id, $session_id)
    {

        return Students::with(['house', 'gender'])
            ->whereHas('SchoolClasses', function ($query) use ($class_id, $arm_id, $session_id) {
                $query->where('class_id', $class_id)
                    ->where('school_arm_id', $arm_id)
                    ->where('academic_session_id', $session_id);
            })->orderBy('surname')
            ->get()
            ->map(fn($sc) => [
                'id' => $sc->students_id,
                'admission_no' => $sc->admission_no,
                'surname' => $sc->surname,
                'firstname' => $sc->firstname,
                'middlename' => $sc->middlename,
                'gendername' => $sc->gender->gendername ?? '',
                'date_of_birth' => $sc->date_of_birth,
                'name' => $sc->house->name ?? '',
                'passport' => $sc->passport,
                'club' => $sc->club ?? '',
                // Example attendance data
                'attendance' => [
                    'opened' => $sc->attendance_opened ?? 0,
                    'present' => $sc->attendance_present ?? 0,
                    'absent' => $sc->attendance_absent ?? 0,
                ],
            ]);              
    }

    /**
     * Get the subjects in a specific class and department.
     *
     * @param int $class_id
     * @param int $department_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getSubjectsInClass($class_id, $department_id) {
        return SchoolSubjects::whereHas('SchoolClasses', function ($query) use ($class_id, $department_id) {
            $query->where('class_id', $class_id)
                ->where('department_id', $department_id);
        })->get();
    }

    /**
     * Get the assessment categories for a specific class.
     *
     * @param int $class_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getAssessmentCategory($class_id) {
        return Assessment_Types::whereHas('classes', function ($query) use ($class_id) {
            $query->where('class_id', $class_id);
        })->get();
    }

    /**
     * Get the grade analysis for all students.
     *
     * @param Collection $students
     * @param Collection $subjects_in_class
     * @param array $subject_summary
     * @return array
     */
    private function getGradeAnalysis($students, $subjects_in_class, $subject_summary) {
        $grade_analysis = [];
        foreach ($students as $student) {
            $student_id = $student['id'];
            foreach ($subjects_in_class as $subject) {
                // Only grade if the student has a score for this subject and the score is greater than zero
                if (
                    isset($subject_summary[$student_id][$subject->id]['total_scores']) &&
                    is_numeric($subject_summary[$student_id][$subject->id]['total_scores']) &&
                    $subject_summary[$student_id][$subject->id]['total_scores'] > 0
                ) {
                    $score = $subject_summary[$student_id][$subject->id]['total_scores'];
                    $grade = gradeOrRemark($score);
                    $grade_analysis[$student_id][$grade] = ($grade_analysis[$student_id][$grade] ?? 0) + 1;
                }
            }
        }

        return $grade_analysis;
    }
    
    public function classReport(Request $request)
    {
        $class_id = $request->class_id;
        $arm_id = $request->class_arm_id;
        $session_id = $request->academic_session_id;
        $term_id = $request->term_id;

        $school_class = SchoolClass::findOrFail($class_id);
        $class_arm = SchoolArms::findOrFail($arm_id);
        $academic_session = SchoolSessions::findOrFail($session_id);
        $term = SchoolTerm::findOrFail($term_id);

        // Determine department based on class name or arm
        $department_id = $this->determineDepartmentId($school_class, $class_arm);

        // Fetch students
        $students = $this->getStudentsInClass($class_id, $arm_id, $session_id);

        // Fetch subjects and assessments
        $subjects_in_class = $this->getSubjectsInClass($class_id, $department_id);

        $assessments = $this->getAssessmentCategory($class_id);

        // Pre-process CASS scores: [student_id][subject_id][cass_type] = ['scores' => ...]
        $students_cass = [];
        $cass_scores = CassScores::where('class_id', $class_id)
            ->where('class_arm_id', $arm_id)
            ->where('academic_session_id', $session_id)
            ->where('term_id', $term_id)
            ->get();
        foreach ($cass_scores as $cass) {
            $students_cass[$cass->student_id][$cass->subject_id][$cass->cass_type] = [
                'scores' => $cass->scores
            ];
        }

        $studentsViaStudentClass = StudentClass::where('class_id', $class_id)
            ->where('school_arm_id', $arm_id)
            ->where('academic_session_id', $session_id)
            ->get();

        $updated_students_cass = [];
        foreach ($students_cass as $student_id_key => $subjects) {
            foreach ($studentsViaStudentClass as $student) {
                $sid = $student->id;
                if ($student_id_key == $sid) {
                    $updated_students_cass[$student->student_id] = $subjects;
                    break;
                }
            }
        }
        $students_cass = $updated_students_cass;


        // Pre-process subject summary: [student_id][subject_id] = [...]
        $subject_summary = [];
        $marks = MarksRegisters::where('class_id', $class_id)
            ->where('class_arm_id', $arm_id)
            ->where('academic_session_id', $session_id)
            ->where('term_id', $term_id)
            ->get();

        foreach ($marks as $mark) {
            $subject_summary[$mark->student_id][$mark->subject_id] = [
                'total_scores' => $mark->total_scores,
                'class_average' => $mark->class_average,
                'class_highest' => $mark->class_highest,
                'class_lowest' => $mark->class_lowest,
                'subject_position' => $mark->subject_position,
            ];
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
        $subject_summary = $updated_subject_summary;
        
        // Pre-process computed results: [student_id] = [...]
        $computed_results = [];
        foreach ($students as $student) {
            $student_id = $student['id'];
            $obtained_marks = 0;
            foreach ($subjects_in_class as $subject) {
                $subject_id = $subject->id;
                $obtained_marks += $subject_summary[$student_id][$subject_id]['total_scores'] ?? 0;
            }
            $total_subjects = count($subjects_in_class);
            $computed_results[$student_id] = [
                'student_id' => $student_id,
                'obtained_marks' => $obtained_marks,
                'total_subjects_offered' => $total_subjects,
                'obtainable_marks' => $total_subjects * 100,
                'average_score' => $total_subjects ? round($obtained_marks / $total_subjects, 2) : 0,
                'position_in_class' => null, // Compute after sorting
            ];
        }
        // Assign positions
        $sorted = $computed_results;
        usort($sorted, fn($a, $b) => $b['average_score'] <=> $a['average_score']);
        foreach ($sorted as $pos => $result) {
            $computed_results[$result['student_id']]['position_in_class'] = $pos + 1;
        }

        // Pre-process grade analysis: [student_id][grade] = count
        $grade_analysis = $this->getGradeAnalysis($students, $subjects_in_class, $subject_summary);

        // Compute class average
        $class_average = $this->computeClassAverage($computed_results);

        // Dates for remarks
        $term_end = now();
        $next_term_start = now()->addMonths(1);

        // Pass to view
        return view('Examination_Officer.class_report_cards', [
            'students' => $students,
            'school_class' => $school_class,
            'class_arm' => $class_arm,
            'academic_session' => $academic_session,
            'term' => $term,
            'subjects_in_class' => $subjects_in_class,
            'assessments' => $assessments,
            'students_cass' => $students_cass,
            'subject_summary' => $subject_summary,
            'computed_results' => $computed_results,
            'grade_analysis' => $grade_analysis,
            'class_average' => $class_average,
            'term_end' => $term_end,
            'next_term_start' => $next_term_start,
        ]);
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
                $row['obtainable_marks'] = $max_subjects_allowed * 100;
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

    public function AnnualStudentReport(Request $request)
    {
        try {
            $class_id = SchoolClass::find($request->class_id);
            $class_arm_id = SchoolArms::find($request->class_arm_id);
            $department_id = strpos($class_id->classname, 'BASIC') !== false ? 4 :
                (strpos($class_arm_id->arm_name, 'A') !== false ? 1 :
                    (strpos($class_arm_id->arm_name, 'B') !== false ? 2 : 3));
            $result_type = 2;
            $academic_session = SchoolSessions::find($request->academic_session_id);
            $terms = SchoolTerm::get()->all();

            $students = StudentClass::join('students', 'students.students_id', 'student_classes.student_id')
                ->join('genders', 'genders.id', '=', 'students.gender')
                ->join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')
                ->where('class_id', '=', $request->class_id)
                ->where('school_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
                ->orderBy('roll_number')
                ->find($request->student_id, ['admission_no', 'student_classes.id as id', 'surname', 'firstname', 'middlename', 'gendername', 'name', 'date_of_birth', 'passport']);

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

            $subject_summary = MarksRegisters::select('student_id', 'total_scores', 'subject_id', 'subject_position', 'term_id')
                ->where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('academic_session_id', $request->academic_session_id)
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
            $max_subjects_allowed = getTotalSubjects($class_id, $subjects_in_class);
            $computed_results = computeResults($subject_summary, $student_obtained_marks, $positions, $max_subjects_allowed, $result_type);
            $class_average = getClassAverage($student_obtained_marks, $max_subjects_allowed, $result_type);
            $annual_subjects_summary = calculateAnnualSubjectsSummary($subject_summary);
            $annual_subject_positions = annualSubjectGrading($annual_subjects_summary, 2);
            $annual_subject_averages = annualSubjectGrading($annual_subjects_summary);
            $annual_subject_high_low = calculateSubjectHighLow($annual_subjects_summary);
            $students_id = $students->id;


            $data['academic_session'] = $academic_session;
            $data['school_class'] = $class_id;
            $data['class_arm'] = $class_arm_id;
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

            return view('Examination_Officer.annual_report_card', $data);

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

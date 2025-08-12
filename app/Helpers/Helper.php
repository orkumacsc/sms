<?php
use App\Models\CassScores;
use App\Models\MarksRegisters;
use App\Models\SchoolClassInfo;
use App\Models\Students;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\CurrentAcademicSeason;
use App\Models\SchoolSessions;
use App\Models\FeesGroup;
use App\Models\FeesType;
use App\Models\SchoolSetup;

// Helers function for school_details

if (!function_exists('SchoolDetails')) {
    function SchoolDetails()
    {
        return SchoolSetup::all()->first();
    }
}


if (!function_exists('CurrentAcademicId')) {
    function CurrentAcademicId()
    {
        $currentAcadSeason = CurrentAcademicSeason::select('session_id as currentSession', 'term_id as currentTerm')
            ->where('active_status', 1)->get();
        return $currentAcadSeason[0];
    }
}

if (!function_exists('active_term')) {
    function Active_Term()
    {
        return DB::table('current_academic_seasons')
            ->join('school_terms', 'school_terms.id', 'current_academic_seasons.term_id')
            ->select(
                'school_terms.name AS term_name',
                'school_terms.id AS term_id',
                'term_start',
                'term_end',
                'next_term_start'
            )->where('active_status', 1)->get()->first();
    }
}

if (!function_exists('active_session')) {
    function Active_Session()
    {
        return SchoolSessions::where('active_status', 1)->get()->first();
    }
}

function FeestoWords($amount)
{
    $toWords = new NumberFormatter("EN", NumberFormatter::SPELLOUT);
    echo ucwords($toWords->format($amount));
}

function formatCurrency($camount)
{
    $toCurrency = new NumberFormatter("EN", NumberFormatter::DECIMAL);
    echo $toCurrency->format($camount);
}

if (!function_exists('isFound')) {
    function isFound($students)
    {
        return count($students) ? true : false;
    }
}

if (!function_exists('isScoresUploaded')) {
    function isScoresUploaded($class_id, $class_arm_id, $subject_id)
    {
        $CASS_Scores = CassScores::select('student_id', 'cass_type', 'scores')
            ->where('class_id', '=', $class_id)
            ->where('class_arm_id', $class_arm_id)
            ->where('academic_session_id', Active_Session()->id)
            ->where('term_id', Active_Term()->term_id)
            ->where('subject_id', $subject_id)
            ->get()->groupBy('cass_type');

        $Marks_Registers = MarksRegisters::where('class_id', '=', $class_id)
            ->where('class_arm_id', $class_arm_id)
            ->where('academic_session_id', Active_Session()->id)
            ->where('term_id', Active_Term()->term_id)
            ->where('subject_id', $subject_id)
            ->get()->all();
        return (count($CASS_Scores) && $Marks_Registers) ? true : false;

    }
}

if (!function_exists('processUpload')) {
    function processUpload($filename)
    {
        $records = [];
        $openedFile = fopen($filename, 'r');

        while (($data = fgetcsv($openedFile))) {
            $records[] = $data;
        }

        fclose($openedFile);
        array_shift($records);
        return $records;
    }
}

if (!function_exists('cass')) {
    function cass($filename)
    {
        $openedFile = fopen($filename, 'r');
        $records = fgetcsv($openedFile);
        fclose($openedFile);

        return $records[0];
    }
}

if (!function_exists('generatePositions')) {
    function generatePositions($CASS_scores)
    {
        $students_marks = [];
        foreach ($CASS_scores as $student_id => $marks) {
            $students_marks[$student_id] = array_sum($marks);
        }
        arsort($students_marks);
        $students_positions = [];

        $i = 0;
        $prev = 0;
        foreach ($students_marks as $student_id => $subject_total) {
            if ($prev != $subject_total) {
                $prev = $subject_total;
                $i++;
            }
            $students_positions[$student_id] = $i;
        }

        return $students_positions;
    }
}

if (!function_exists('suffix')) {
    function suffix($n)
    {
        $str = "$n";
        $t = $n > 9 ? substr($str, -2, 1) : 0;
        $u = substr($str, -1);
        if ($t == 1)
            return $str . 'th';
        else
            switch ($u) {
                case 1:
                    return $str . 'st';
                case 2:
                    return $str . 'nd';
                case 3:
                    return $str . 'rd';
                default:
                    return $str . 'th';
            }
        ;
    }
}

if (!function_exists('gradeOrRemark')) {
    function gradeOrRemark($average, $isRemark = false, $isComment = false)
    {
        if ($average >= 75) {
            $grade = 'A';
            $remarkText = 'EXCELLENT';
        } elseif ($average >= 65) {
            $grade = 'B';
            $remarkText = 'VERY GOOD';
        } elseif ($average >= 55) {
            $grade = 'C';
            $remarkText = 'GOOD';
        } elseif ($average >= 40) {
            $grade = 'D';
            $remarkText = 'FAIR';
        } else {
            $grade = 'E';
        $remarkText = 'FAIL';
    }
   

        $comment = fn($average) => match ($average) {
            $average >= 75 => 'A - PASSED',
            $average >= 65 => 'B - PASSED',
            $average >= 55 => 'C - PASSED',
            $average >= 40 => 'D - PASSED',
            default => 'E - FAILED',
        };

        return $isComment ? $comment($average) : ($isRemark ? $remarkText : $grade);
    }
}

if (!function_exists('calculateObtainedMarks')) {
    function calculateObtainedMarks($data)
    {
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
    }
}

if (!function_exists('calculatePositions')) {
    function calculatePositions($data)
    {
        $students_positions = [];
        $i = 0;
        $prev = 0;
        foreach ($data as $student_id => $subject_total) {
            if ($prev != $subject_total) {
                $prev = $subject_total;
                $i++;
            }
            $students_positions[$student_id] = $i;
        }
        return $students_positions;
    }
}

if (!function_exists('calculateAnnualSubjectsSummary')) {
    function calculateAnnualSubjectsSummary($subject_entries)
    {
        $scores_by_student = [];
        foreach ($subject_entries as $student_id => $subject_entry) {

            $scores_by_subject = [];
            foreach ($subject_entry as $entries) {

                $subject_id = $entries['subject_id'];
                $score = $entries['total_scores'];

                if (!isset($scores_by_subject[$subject_id])) {
                    $scores_by_subject[$subject_id] = 0;
                }

                $scores_by_subject[$subject_id] += $score;
            }
            $scores_by_student[$student_id] = $scores_by_subject;
        }

        return $scores_by_student;
    }
}

if (!function_exists('groupBySubject')) {
    function groupBySubject($combined_scores)
    {
        $group_by_subject = [];
        foreach ($combined_scores as $student_id => $combined_score) {
            foreach ($combined_score as $subject_id => $score) {
                $group_by_subject[$subject_id][$student_id] = $score;
            }
        }
        return $group_by_subject;
    }
}

if (!function_exists('groupByStudents')) {
    function groupByStudents($combined_scores)
    {
        $group_by_student = [];
        foreach ($combined_scores as $subject_id => $combined_score) {
            foreach ($combined_score as $students_info) {
                foreach ($students_info as $student_id => $value) {
                    $group_by_student[$student_id][$subject_id] = $value;
                }
            }
        }
        return $group_by_student;
    }
}


if (!function_exists('calculateAnnualAverage')) {
    function calculateAnnualAverage($students_combined_scores, $no_of_terms)
    {
        $subjects_annual_average = [];
        foreach ($students_combined_scores as $student_id => $combined_score) {
            $subjects_annual_average[$student_id] = (float) number_format($combined_score / $no_of_terms, 2);
        }

        return $subjects_annual_average;
    }
}

if (!function_exists('annualSubjectGrading')) {
    function annualSubjectGrading($subject_combined_scores, $grade_type = 1)
    {
        $results = [];

        $grouped_by_subjects = groupBySubject($subject_combined_scores);
        foreach ($grouped_by_subjects as $subject_id => $student_combined_scores) {
            $students_scores = $student_combined_scores;
            arsort($students_scores);

            switch ($grade_type) {
                case 1:
                    $results[$subject_id]['average'] = calculateAnnualAverage($students_scores, 3);
                    break;
                case 2:
                    $results[$subject_id]['position'] = calculatePositions($students_scores);
                    break;               
            }
        }

        return groupByStudents($results);
    }

}


if (!function_exists('calculateSubjectHighLow')) {
    function calculateSubjectHighLow($subject_combined_scores)
    {
        $results = [];

        $grouped_by_subjects = groupBySubject($subject_combined_scores);
        foreach ($grouped_by_subjects as $subject_id => $student_combined_scores) {
            $students_scores = $student_combined_scores;
            arsort($students_scores); 

            $results[$subject_id]['class_average'] = (float) number_format(array_sum($students_scores) / (count($students_scores) * 3), 2);
            $results[$subject_id]['class_highest'] = max($students_scores);
            $results[$subject_id]['class_lowest'] = min($students_scores);
        }

        return $results;
    }
}




if (!function_exists('computeResults')) {
    function computeResults($result_summary, $student_obtained_marks, $positions, $no_subjects_offered, $result_type = null)
    {
        $rows = [];
        foreach ($result_summary as $student_id => $Student_result) {

            $total_subjects = (int) $result_type != null ?
                ($no_subjects_offered * 3) ?? (count($Student_result) * 3) :
                ($no_subjects_offered ?? count($Student_result));

            $row = [];
            $row['student_id'] = $student_id;
            $row['obtained_marks'] = $student_obtained_marks[$student_id];
            $row['total_subjects_offered'] = $total_subjects;
            $row['obtainable_marks'] = $total_subjects * 100;
            $row['average_score'] = (float) number_format(($row['obtained_marks'] * 100) / $row['obtainable_marks'], 2) ?? 0.00;
            $row['position_in_class'] = $positions[$student_id];
            $rows[$student_id] = $row;
        }

        return $rows;
    }
}

if (!function_exists('getClassAverage')) {
    function getClassAverage($student_obtained_marks, $subjects_in_class, $result_type = null)
    {
        $total_subjects = (int) $result_type != null ? $subjects_in_class * 3 : $subjects_in_class;

        return (float) number_format(
            (array_sum($student_obtained_marks) /
                count($student_obtained_marks)) /
            $total_subjects,
            2
        );
    }
}

if (!function_exists('getDepartmentId')) {
    function getDepartmentId($class_name, $class_arm_name)
    {
        return strpos($class_name, 'BASIC') !== false ? 4 :
            (strpos($class_arm_name, 'A') !== false ? 1 :
                (strpos($class_arm_name, 'B') !== false ? 2 : 3));

    }
}

if (!function_exists('getStudentId')) {
    function getStudentId($admission_no)
    {
        $student_id = Students::select('students_id')
            ->where('admission_no', $admission_no)
            ->get()->first();

        return $student_id->students_id ?? null;
    }
}

if (!function_exists('getTotalSubjects')) {
    function getTotalSubjects($class_id, $subjects_in_class)
    {
        $total_subjects_offered = SchoolClassInfo::select('total_subjects_offered')
            ->where('class_id', $class_id)
            ->get()->first();

        return $total_subjects_offered ? (int) $total_subjects_offered->total_subjects_offered : count($subjects_in_class);

    }
}
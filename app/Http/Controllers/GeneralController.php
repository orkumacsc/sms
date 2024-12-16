<?php

namespace App\Http\Controllers;

use App\Models\CurrentAcademicSeason;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\LocalGovts;
use App\Models\States;
use App\Models\FeesType;
use App\Models\Students;
use App\Models\AssignClassFee;
use App\Models\ClassSubjects;
use DB;

class GeneralController extends Controller
{

    public function SchoolFees($id)
    {
        $amount = FeesType::find($id);
        return response()->json($amount);
    }


    public function StudentByClass($id)
    {
        $Students = Students::select('students_id', 'surname', 'firstname', 'middlename')->where('students.class', $id)->get();

        return response()->json($Students);
    }

    public function FeesDue($id)
    {
        $current = CurrentAcademicId();
        $cu_term = $current->currentTerm;
        $cu_session = $current->currentSession;

        $FeesDue = AssignClassFee::select('id', 'fee_type_id', 'fee_amount')
            ->where('assign_class_fees.class_id', $id)
            ->where('assign_class_fees.acad_id', $cu_session)
            ->where('assign_class_fees.term_id', $cu_term)
            ->get();

        return response()->json($FeesDue);
    }

    public function getSubject($id)
    {
        $Subjects = ClassSubjects::join('school_subjects', 'school_subjects.id', 'class_subjects.subject_id')
            ->select('subject_id', 'subject_name')->where('class_subjects.class_id', $id)->orderBy('subject_name')
            ->get();

        return response()->json($Subjects);
    }

    public function GetLGA($id)
    {
        $LGAs = LocalGovts::select('id', 'name')->where('local_govts.states_id', $id)->orderBy('name')
            ->get();
        return response()->json($LGAs);
    }


    public function AdmittedStudents($class_info)
    {
        $class_data = explode('_', $class_info);
        $class_id = $class_data[0];
        $arm_id = $class_data[1];

        $students_info = StudentClass::select('id', 'student_id')
            ->where('student_classes.class_id', $class_id)
            ->where('student_classes.school_arm_id', $arm_id)
            ->where('student_classes.academic_session_id', CurrentAcademicId()->currentSession)
            ->get();

        $numberAdmitted = count($students_info);

        return response()->json($numberAdmitted);
    }


    public function students($students)
    {
        $class_data = explode('_', $students);
        $class_id = $class_data[0];
        $school_arm_id = $class_data[1];
        $academic_session_id = $class_data[2];

        $Students = StudentClass::select('id', 'student_id', 'surname', 'firstname', 'middlename')
            ->join('students', 'students.students_id', 'student_classes.student_id')
            ->where('class_id', $class_id)
            ->where('school_arm_id', $school_arm_id)
            ->where('academic_session_id', $academic_session_id)
            ->orderBy('roll_number')
            ->get();

        return response()->json($Students);
    }
}

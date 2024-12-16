<?php

namespace App\Http\Controllers;

use App\Models\CassScores;
use App\Models\ClassSubjects;
use App\Models\MarksRegisters;
use App\Models\ResultPositions;
use App\Models\SchoolArms;
use App\Models\SchoolAssessments;
use App\Models\SchoolClass;
use App\Models\SchoolSessions;
use App\Models\SchoolTerm;
use App\Models\StudentClass;
use App\Models\Students;
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

        $students_id = Students::select('students_id', 'admission_no')
            ->where('admission_no', $input['admission_number'])
            ->get()->first();
        
        if(!$students_id) return view('Students.no_records',$input);

        
        $student_id = StudentClass::select('admission_no', 'student_classes.id as id', 'surname', 'firstname', 'middlename', 'gendername', 'name', 'date_of_birth')
            ->join('students', 'students.students_id', 'student_classes.student_id')
            ->join('genders', 'genders.id', '=', 'students.gender')
            ->join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')
            ->where('class_id', '=', $request->class_id)           
            ->where('student_id', $students_id->students_id)
            ->get()->first();
        
        $data['academic_session'] = SchoolSessions::find($input['academic_session_id']);
        $data['school_class'] = SchoolClass::find($input['class_id']);
        $data['class_arm'] = SchoolArms::find($input['class_arm_id']);
        $data['term'] = SchoolTerm::find($input['term_id']);
        $data['students'] = $student_id;

        $data['assessments'] = SchoolAssessments::where('class_id', '=', $input['class_id'])
            ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')
            ->orderBy('school_assessments.id', 'ASC')
            ->get();

        $data['subjects_in_class'] = ClassSubjects::where('class_id', $input['class_id'])
            ->join('school_subjects', 'school_subjects.id', 'class_subjects.subject_id')
            ->orderBy('school_subjects.subject_name', 'ASC')
            ->get();

        $data['students_cass'] = CassScores::select('student_id', 'cass_type', 'scores', 'subject_id')
            ->where('class_id', '=', $input['class_id'])
            ->where('class_arm_id', $input['class_arm_id'])
            ->where('academic_session_id', $input['academic_session_id'])
            ->where('term_id', $input['term_id'])
            ->where('student_id', $student_id->id)
            ->get();

        $data['subject_summary'] = MarksRegisters::select('student_id', 'total_scores', 'subject_id', 'subject_position')
            ->where('class_id', '=', $input['class_id'])
            ->where('class_arm_id', $input['class_arm_id'])
            ->where('academic_session_id', $input['academic_session_id'])
            ->where('term_id', $input['term_id'])
            ->where('student_id', $student_id->id)
            ->get();

        $data['computed_results'] = ResultPositions::where('class_arm_id', $input['class_arm_id'])
            ->where('session_id', $input['academic_session_id'])
            ->where('term_id', $input['term_id'])
            ->where('class_id', '=', $input['class_id'])
            ->where('student_id', $student_id->id)
            ->get()->first();
        
        
        

        $check_back['students'] = $student_id;
        $check_back['academic_session'] = $data['academic_session']->name;
        $check_back['term'] = $data['term']->name;
        
        unset($request);
        return
            $data['computed_results'] && $data['subject_summary'] && $data['students_cass'] ?
            view('Students.students_report_card', $data) :
            view('Students.check_back', $check_back);

    }
}

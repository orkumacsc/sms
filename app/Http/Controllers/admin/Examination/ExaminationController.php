<?php

namespace App\Http\Controllers\Admin\Examination;

use App\Http\Controllers\Controller;
use App\Models\ClassSubjects;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\SchoolClass;
use App\Models\SchoolSessions;
use App\Models\SchoolTerm;
use App\Models\SchoolArms;
use App\Models\MarksRegisters;
use App\Models\ResultPositions;
use Auth;


class ExaminationController extends Controller
{
     public function __construct()
     {
          $this->middleware('auth');
     }

     public function Index()
     {
          try {
               $data['SchoolClasses'] = SchoolClass::all();
               $data['SchoolArms'] = SchoolArms::all();
               return view('backend.Examination.exam_card', $data);

          } catch (\Exception $e) {
               $notifications = [
                    'message' => 'Error processing request',
                    'alert-type' => 'error'
               ];

               return back()->with($notifications);
          }
     }

     public function GenerateExamCard(Request $request)
     {
          try {
               $data['Students'] = StudentClass::join('students', 'students.students_id', '=', 'student_classes.student_id')
                    ->orderBy('students.surname', 'ASC')
                    ->join('school_classes', 'school_classes.id', '=', 'student_classes.class_id')
                    ->join('school_arms', 'school_arms.id', '=', 'student_classes.school_arm_id')
                    ->join('genders', 'genders.id', '=', 'students.gender')
                    ->where('class_id', '=', $request->class)
                    ->where('school_arm_id', '=', $request->arm_id)
                    ->where('academic_session_id', '=', Active_Session()->id)->get()->all();

               $notifications = [
                    'message' => 'No Student(s) found in the selected class for ' . Active_Session()->name . ' academic session',
                    'alert-type' => 'info'
               ];
               return count($data['Students']) ? view('backend.Examination.exam_card_view', $data) : back()->with($notifications);
          } catch (\Exception $e) {

               $notifications = [
                    'message' => 'System could not generate students\' exam card.',
                    'alert-type' => 'error'
               ];

               return back()->with($notifications);
          }
     }

     public function Attendance()
     {
          $data['SchoolClasses'] = SchoolClass::all();
          $data['SchoolArms'] = SchoolArms::all();
          return view('backend.Examination.exam_attendance', $data);
     }

     public function AttendanceGenerate(Request $request)
     {
          try {
               $data['current_class'] = SchoolClass::find($request->class);
               $data['class_arm'] = SchoolArms::find($request->class_arm);
               $data['Students'] = StudentClass::join('students', 'students.students_id', '=', 'student_classes.student_id')
                    ->orderBy('student_classes.roll_number', 'ASC')
                    ->join('school_classes', 'school_classes.id', '=', 'student_classes.class_id')
                    ->join('school_arms', 'school_arms.id', '=', 'student_classes.school_arm_id')
                    ->join('genders', 'genders.id', '=', 'students.gender')
                    ->where('class_id', '=', $request->class)
                    ->where('school_arm_id', '=', $request->class_arm)
                    ->where('academic_session_id', '=', Active_Session()->id)->get()->all();

               $notifications = [
                    'message' => 'No Student(s) found in the selected class for ' . Active_Session()->name . ' academic session',
                    'alert-type' => 'info'
               ];
               return count($data['Students']) ? view('backend.Examination.attendance_view', $data) : back()->with($notifications);
          } catch (\Exception $e) {
               $notifications = [
                    'message' => 'System could not generate students\' attendance sheet.',
                    'alert-type' => 'error'
               ];

               return back()->with($notifications);
          }

     }

     public function resultIndex()
     {
          $data['SchoolTerm'] = SchoolTerm::all();
          $data['SchoolSessions'] = SchoolSessions::all();
          $data['SchoolClasses'] = SchoolClass::all();
          $data['ClassArms'] = SchoolArms::all();

          return view('Examination_Officer.result_index', $data);
     }

     public function storeComputeResult(Request $request)
     {
          $subjects_in_class = ClassSubjects::where('class_id', $request->class_id)
               ->join('school_subjects', 'school_subjects.id', 'class_subjects.subject_id')
               ->orderBy('school_subjects.subject_name', 'ASC')
               ->get();
          $notifications = [
               'message' => 'No subject found in class. Please add subject to class!',
               'alert-type' => 'info'
          ];

          if (!count($subjects_in_class))
               return back()->with($notifications);

          $Result_details = MarksRegisters::select('student_id', 'total_scores')
               ->where('class_id', $request->class_id)
               ->where('class_arm_id', $request->class_arm_id)
               ->where('academic_session_id', $request->academic_session_id)
               ->where('term_id', $request->term_id)
               ->get()->groupBy('student_id');

          $notifications = [
               'message' => 'No continuous Assessment Uploaded for the selected class.',
               'alert-type' => 'info'
          ];

          if (!count($Result_details))
               return back()->with($notifications);

          $student_obtained_marks = (function ($data) {
               $students_marks = [];
               foreach ($data as $student_id => $students) {
                    $obtained_marks = 0;
                    foreach ($students as $student) {
                         $obtained_marks += $student->total_scores;
                    }
                    $students_marks[$student_id] = $obtained_marks;
               }
               arsort($students_marks);

               return $students_marks;
          })($Result_details);


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

          try {
               $rows = [];
               foreach ($Result_details as $student_id => $Student_result) {
                    $row = [];
                    $row['session_id'] = Active_Session()->id;
                    $row['term_id'] = Active_Term()->term_id;
                    $row['class_id'] = $request->class_id;
                    $row['class_arm_id'] = $request->class_arm_id;
                    $row['obtained_marks'] = $student_obtained_marks[$student_id];
                    $row['student_id'] = $student_id;
                    $row['computed_by'] = Auth::user()->id;
                    $row['total_subjects_offered'] = count($Student_result);
                    $row['obtainable_marks'] = count($subjects_in_class) * 100;
                    $row['average_score'] = number_format(($row['obtained_marks'] * 100) / $row['obtainable_marks'], 2) ?? 0.00;
                    $row['position_in_class'] = $positions[$student_id];
                    $rows[] = $row;
               }

               $ResultPositions = new ResultPositions();
               $ResultPositions->create($rows);

               $success = [
                    'message' => 'Result Successfully Computed for the selected Class',
                    'alert-type' => 'success'
               ];

               return back()->with($success);

          } catch (\Exception $e) {
               $notifications = array(
                    [
                         'message' => 'Error in Computing Result! Contact Support.',
                         'alert-type' => 'error'
                    ]
               );

               return redirect()->back()->with($notifications);
          }
     }
}

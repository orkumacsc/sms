<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCassScoresRequest;
use App\Http\Requests\UpdateCassScoresRequest;
use App\Models\StudentClass;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CassScores;
use App\Models\SchoolClass;
use App\Models\SchoolTerm;
use App\Models\SchoolAssessments;
use App\Models\SchoolArms;
use App\Models\SchoolSessions;
use App\Models\SchoolSubjects;
use App\Models\MarksRegisters;

use Auth;
use Response;
use Storage;


class CassScoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload()
    {
        $data['SchoolClasses'] = SchoolClass::all();
        $data['SchoolTerm'] = SchoolTerm::all();
        $data['SchoolSessions'] = SchoolSessions::all();
        $data['SchoolSubjects'] = SchoolSubjects::all();
        $data['ClassArms'] = SchoolArms::all();

        return view('backend.Examination.request_form', $data);

    }

    public function uploadForm(Request $request)
    {
        if (!isScoresUploaded($request->class_id, $request->arm_id, $request->subject_id)) {
            $data['Current_Class'] = SchoolClass::find($request->class_id);
            $data['Class_Arm'] = SchoolArms::find($request->arm_id);
            $data['subject'] = SchoolSubjects::find($request->subject_id);
            $data['Students'] = StudentClass::join('students', 'students.students_id', 'student_classes.student_id')
                ->where('class_id', '=', $request->class_id)
                ->where('school_arm_id', $request->arm_id)
                ->where('academic_session_id', Active_Session()->id)
                ->orderBy('roll_number', 'ASC')->get()->all();
            $data['Assessments'] = SchoolAssessments::where('class_id', '=', $request->class_id)->join('school_classes', 'school_classes.id', '=', 'school_assessments.class_id')
                ->orderBy('school_classes.id', 'ASC')->orderBy('school_assessments.id', 'ASC')
                ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')->get()->all();

            $notifications = [
                'message' => 'No Student was found in the selected class',
                'alert-type' => 'info'
            ];

            return isFound($data['Students']) ? view('backend.Examination.cass_entry_form', $data) : back()->with($notifications);
        } else {
            $notifications = [
                'message' => 'Continous Assessment Scores already uploaded for the selected class & subject',
                'alert-type' => 'info'
            ];
            return back()->with($notifications);
        }
    }

    public function uploadScores(StoreCassScoresRequest $request)
    {
        $CASS_scores = $request->scores;
        $students_positions = generatePositions($CASS_scores);

        try {
            $rows = [];
            foreach ($CASS_scores as $id => $marks) {
                foreach ($marks as $cass => $mark) {
                    $row = [];
                    $row['student_id'] = $id;
                    $row['subject_id'] = $request->subject;
                    $row['cass_type'] = $cass;
                    $row['scores'] = $mark ?? 0;
                    $row['class_id'] = $request->class_id;
                    $row['class_arm_id'] = $request->class_arm_id;
                    $row['term_id'] = Active_Term()->term_id;
                    $row['academic_session_id'] = Active_Session()->id;
                    $rows[] = $row;
                }
            }

            $cassScores = new CassScores();
            $cassScores->create($rows);


            try {
                $records = [];
                foreach ($CASS_scores as $student => $scores) {
                    $record = [];
                    $record['total_scores'] = array_sum($scores);
                    $record['subject_position'] = $students_positions[$student];
                    $record['subject_id'] = $request->subject;
                    $record['class_id'] = $request->class_id;
                    $record['class_arm_id'] = $request->class_arm_id;
                    $record['academic_session_id'] = Active_Session()->id;
                    $record['student_id'] = $student;
                    $record['term_id'] = Active_Term()->term_id;
                    $records[] = $record;
                }

                $MarksRegisters = new MarksRegisters();
                $MarksRegisters->create($records);

                $notifications = [
                    'message' => 'Continuous Assessment Scores Successfully Uploaded!',
                    'alert-type' => 'success'
                ];

                return redirect('UploadResult')->with($notifications);

            } catch (\Exception $e) {
                $notifications = array(
                    [
                        'message' => $e,
                        'alert-type' => 'error'

                    ]
                );
                return redirect()->back()->with($notifications);
            }
        } catch (\Exception $e) {
            $notifications = array(
                [
                    'message' => $e,
                    'alert-type' => 'error'

                ]
            );

            return redirect()->back()->with($notifications);
        }
    }

    public function updateUploadedCass(Request $request)
    {
        $data['class'] = SchoolClass::find($request->class_id);
        $data['class_arm'] = SchoolArms::find($request->class_arm_id);
        $data['subject'] = SchoolSubjects::find($request->subject_id);
        $data['Students'] = StudentClass::join('students', 'students.students_id', 'student_classes.student_id')
            ->where('class_id', '=', $request->class_id)
            ->where('school_arm_id', $request->class_arm_id)
            ->where('academic_session_id', Active_Session()->id)
            ->orderBy('roll_number')
            ->get();

        $data['CASS_Scores'] = CassScores::select('student_id', 'cass_type', 'scores')
            ->where('class_id', '=', $request->class_id)
            ->where('class_arm_id', $request->class_arm_id)
            ->where('academic_session_id', Active_Session()->id)
            ->where('term_id', Active_Term()->term_id)
            ->where('subject_id', $request->subject_id)
            ->get()->groupBy('cass_type');

        $data['Assessments'] = SchoolAssessments::where('class_id', '=', $request->class_id)
            ->join('school_classes', 'school_classes.id', '=', 'school_assessments.class_id')
            ->orderBy('school_classes.id', 'ASC')->orderBy('school_assessments.id', 'ASC')
            ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')
            ->get();

        $cass_notification = [
            'message' => 'Continuous Assessment Scores has not been uploaded for the selected subject in the selected Class. Please upload CASS.',
            'alert-type' => 'info'
        ];
        $students_notification = [
            'message' => 'There is no student in the selected class.',
            'alert-type' => 'info'
        ];

        return isFound($data['Students']) ?
            (isFound($data['CASS_Scores']) ?
                view('backend.Examination.update_uploaded_cass', $data) :
                back()->with($cass_notification)) :
            back()->with($students_notification);

    }

    public function updateScores(Request $request)
    {
        $CASS_scores = $request->scores;
        $students_positions = generatePositions($CASS_scores);

        try {
            $rows = [];
            foreach ($CASS_scores as $id => $marks) {
                foreach ($marks as $cass => $mark) {
                    $row = [];
                    $row['student_id'] = $id;
                    $row['subject_id'] = $request->subject;
                    $row['cass_type'] = $cass;
                    $row['scores'] = $mark ?? 0;
                    $row['class_id'] = $request->class_id;
                    $row['class_arm_id'] = $request->class_arm_id;
                    $row['term_id'] = $request->current_term;
                    $row['academic_session_id'] = $request->current_session;
                    $rows[] = $row;
                }
            }
            dd($rows);

            $cassScores = new CassScores();
            $cassScores->create($rows);


            try {
                $records = [];
                foreach ($CASS_scores as $student => $scores) {
                    $record = [];
                    $record['total_scores'] = array_sum($scores);
                    $record['subject_position'] = $students_positions[$student];
                    $record['subject_id'] = $request->subject;
                    $record['class_id'] = $request->class_id;
                    $record['class_arm_id'] = $request->class_arm_id;
                    $record['academic_session_id'] = $request->current_session;
                    $record['student_id'] = $student;
                    $record['term_id'] = $request->current_term;
                    $records[] = $record;
                }

                $MarksRegisters = new MarksRegisters();
                $MarksRegisters->create($records);

                $notifications = [
                    'message' => 'Continuous Assessment Scores Successfully Uploaded!',
                    'alert-type' => 'success'
                ];

                return redirect('UploadResult')->with($notifications);

            } catch (\Exception $e) {
                $notifications = array(
                    [
                        'message' => $e,
                        'alert-type' => 'error'

                    ]
                );
                return redirect()->back()->with($notifications);
            }
        } catch (\Exception $e) {
            $notifications = array(
                [
                    'message' => $e,
                    'alert-type' => 'error'

                ]
            );

            return redirect()->back()->with($notifications);
        }
    }

    public function downloadOffline(Request $request)
    {
        $data['Students'] = StudentClass::select('id', 'students_id', 'admission_no', 'surname', 'firstname', 'middlename')
            ->join('students', 'students.students_id', 'student_classes.student_id')
            ->where('class_id', '=', $request->class_id)
            ->where('school_arm_id', $request->arm_id)
            ->where('academic_session_id', Active_Session()->id)
            ->orderBy('roll_number', 'ASC')->get();

        $data['Assessments'] = SchoolAssessments::where('class_id', '=', $request->class_id)
            ->join('school_classes', 'school_classes.id', '=', 'school_assessments.class_id')
            ->orderBy('school_classes.id', 'ASC')->orderBy('school_assessments.id', 'ASC')
            ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')->get()->all();

        $class = SchoolClass::find($request->class_id)->toArray();
        $class_arm = SchoolArms::find($request->arm_id)->toArray();
        $subject = SchoolSubjects::find($request->subject_id)->toArray();

        $rows = [];
        $columns = [];

        foreach ($data['Assessments'] as $assessement) {
            $columns[] = $assessement->name;
        }

        $rows[] = ['Students_id', 'Admission No.', 'Full Name', ...$columns];

        foreach ($data['Students'] as $student) {
            $rows[] = [$student->id, $student->admission_no, trim("$student->surname $student->firstname $student->middlename")];
        }


        $filename = trim($class['classname'] . $class_arm['arm_name'] . $subject['subject_name']) . '.csv';

        $openedFile = fopen($filename, mode: 'w');

        if (!$openedFile) {
            return back()->with();
        }

        foreach ($rows as $row) {
            fputcsv($openedFile, $row);
        }

        fclose($openedFile);

        return Response::download($filename);
    }

    public function offlineUpload(Request $request)
    {
        try {
            //Checks if there are students in the selected class
            $students_numbers = (function ($class_id, $class_arm_id) {
                $students = StudentClass::select('id', 'students_id', 'admission_no', 'surname', 'firstname', 'middlename')
                    ->join('students', 'students.students_id', 'student_classes.student_id')
                    ->where('class_id', '=', $class_id)
                    ->where('school_arm_id', $class_arm_id)
                    ->where('academic_session_id', Active_Session()->id)
                    ->orderBy('roll_number', 'ASC')->get();

                $students_numbers = [];
                foreach ($students as $student) {
                    $students_numbers[$student->students_id] = $student->id;
                }

                return $students_numbers;
            })($request->class_id, $request->class_arm_id);

            $notifications = [
                'message' => 'There is no student in the selected class!',
                'alert-type' => 'info'
            ];
            if (count($students_numbers) <= 0)
                return back()->with($notifications);

            //Checks if assessment category/type has been assigned to the selected class
            $cass_type = (function ($class_id) {
                $assessment = SchoolAssessments::where('class_id', '=', $class_id)->join('school_classes', 'school_classes.id', '=', 'school_assessments.class_id')
                    ->orderBy('school_classes.id', 'ASC')->orderBy('school_assessments.id', 'ASC')
                    ->join('assessment__types', 'assessment__types.id', '=', 'school_assessments.ass_type_id')->get()->all();

                $cass_type = [];
                foreach ($assessment as $cass) {
                    $cass_type[] = $cass->id;
                }

                return $cass_type;
            })($request->class_id);

            $notifications = [
                'message' => 'There is no assessment type/category assigned to the selected class!',
                'alert-type' => 'info'
            ];

            if (count($cass_type) <= 0)
                return back()->with($notifications);

            //Validates the correctness of the selected parameters against the scoresheet file submited
            $_class = SchoolClass::find($request->class_id);
            $class_arm = SchoolArms::find($request->class_arm_id);
            $subject = SchoolSubjects::find($request->subject_id);
            $uploaded_filename = $request->file('scoresheet')->getClientOriginalName();

            $isClassMatch = strpos($uploaded_filename, $_class->classname) !== false ? true : false;
            $isClassArmMatch = strpos($uploaded_filename, $class_arm->arm_name) !== false ? true : false;
            $isSubjectMatch = strpos($uploaded_filename, $subject->subject_name) !== false ? true : false;

            $info = [
                'class_info' => $notifications = [
                    'message' => "Selected class and uploaded scoresheet file class do not match! Please check and submit again!",
                    'alert-type' => 'info'
                ],
                'subject' => $notifications = [
                    'message' => "Selected subject and uploaded scoresheet file subject do not match! Please check and submit again!",
                    'alert-type' => 'info'
                ]
            ];

            if (($isClassMatch !== true || $isClassArmMatch !== true))
                return back()->with($info['class_info']);

            if ($isSubjectMatch !== true)
                return back()->with($info['subject']);
            //End validation

            $students_info = array_map('str_getcsv', file($request->file('scoresheet')->getRealPath()));
            array_shift($students_info);

            //Determines the position of students in the selected subject
            $students_positions = (function ($CASS_scores, $cass_type) {
                $students_marks = [];
                foreach ($CASS_scores as $student_id => $marks) {
                    $students_marks[$marks[0]] = array_sum(array_slice($marks, -count($cass_type)));
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
            })($students_info, $cass_type);

            //Checks if Students class_id exists in $students_numbers @param
            function numberExists($class_id, $students_numbers)
            {
                return array_key_exists($class_id[0], $students_numbers) ? $students_numbers[$class_id[0]] : $class_id[0];
            }

            //Deletes existing continuous assessment records if exits
            CassScores::where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('academic_session_id', Active_Session()->id)
                ->where('term_id', Active_Term()->term_id)
                ->where('subject_id', $request->subject_id)
                ->delete();

            MarksRegisters::where('class_id', '=', $request->class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('academic_session_id', Active_Session()->id)
                ->where('term_id', Active_Term()->term_id)
                ->where('subject_id', $request->subject_id)
                ->delete();

            try {
                $rows = [];
                foreach ($students_info as $marks) {
                    $i = 3;
                    while ($i != count($marks)) {
                        $row = [];
                        $row['student_id'] = numberExists($marks, $students_numbers);
                        $row['subject_id'] = $request->subject_id;
                        $row['cass_type'] = $cass_type[$i - 3];
                        $row['scores'] = $marks[$i] != null ? $marks[$i] : 0;
                        $row['class_id'] = $request->class_id;
                        $row['class_arm_id'] = $request->class_arm_id;
                        $row['term_id'] = Active_Term()->term_id;
                        $row['academic_session_id'] = Active_Session()->id;
                        $rows[] = $row;
                        $i++;
                    }
                }

                $cassScores = new CassScores();
                $cassScores->create($rows);


                try {
                    $records = [];
                    foreach ($students_info as $student) {
                        $record = [];
                        $record['student_id'] = numberExists($student, $students_numbers);
                        $record['total_scores'] = array_sum(array_slice($student, -count($cass_type)));
                        $record['subject_position'] = $students_positions[$student[0]];
                        $record['subject_id'] = $request->subject_id;
                        $record['class_id'] = $request->class_id;
                        $record['class_arm_id'] = $request->class_arm_id;
                        $record['academic_session_id'] = Active_Session()->id;
                        $record['term_id'] = Active_Term()->term_id;
                        $records[] = $record;
                    }

                    $MarksRegisters = new MarksRegisters();
                    $MarksRegisters->create($records);

                    $notifications = [
                        'message' => 'Continuous Assessment Scores Successfully Uploaded!',
                        'alert-type' => 'success'
                    ];
                    return back()->with($notifications);

                } catch (\Exception $e) {
                    $notifications = [
                        'message' => "Continuous Assessment Scores Calculated Failed! Please Contact Support!",
                        'alert-type' => 'error'
                    ];
                    return back()->with($notifications);
                }

            } catch (\Exception $e) {
                $notifications = [
                    'message' => "Continuous Assessement Upload Failed! Please Contact Support!",
                    'alert-type' => 'error'
                ];
                return back()->with($notifications);
            }

        } catch (\Exception $e) {
            $notifications = [
                'message' => "Operation Failed! Please Contact Support!",
                'alert-type' => 'error'
            ];
            return back()->with($notifications);
        }
    }
}

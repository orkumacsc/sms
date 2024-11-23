<?php

namespace App\Http\Controllers;
use App\Models\SchoolClass;
use App\Models\SchoolArms;
use App\Models\StudentClass;
use App\Models\Students;
use App\Models\SchoolSessions;
use DB;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class StudentPromteController extends Controller
{
    //
    
    public function Index()
    {        
        $data['Classes'] = SchoolClass::all();        
        $data['ClassArms'] = SchoolArms::all();
        $data['SchoolSessions'] = SchoolSessions::all();

        return view('backend.admin.StudentManagement.student_promotion',$data);
    }

    public function ViewCurrentStudents(Request $request)
    {
        $validator = validator::make($request->all(), [            
            'current_class' => 'required',
            'current_class_arm' => 'required',
            'academic_session'  => 'required'            
        ]);

        if($validator->fails()){
            $errors = $validator->errors();

            foreach($errors->all() as $error){

                $notifications = array(
                    'message' => $error,
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notifications);

            }
        } else {
                $data['Classes'] = SchoolClass::all();        
                $data['ClassArms'] = SchoolArms::all();
                $data['current_arm'] = SchoolArms::find($request->current_class_arm);
                $data['current_class'] = SchoolClass::find($request->current_class);
                $data['current_session'] = SchoolSessions::find($request->academic_session);
                $data['StudentDetails'] = StudentClass::join('students','students.students_id','student_classes.student_id')
                    ->select('students.students_id', 'students.admission_no', 'students.surname', 'students.firstname', 'students.middlename')
                        ->orderBy('students.surname', 'ASC')
                            ->where('student_classes.class_id','=',$request->current_class)
                                ->where('student_classes.school_arm_id','=',$request->current_class_arm)
                                    ->where('student_classes.academic_session_id', '=', $request->academic_session)->get();
            
                                    $notifications = array(
                'message' => 'No Student was found in the selected class.',
                'alert-type' => 'info'
            );
            return count($data['StudentDetails']) ? view('backend.admin.StudentManagement.student_promotion_view', $data) : redirect()->back()->with($notifications);
            
        }
        
    }

    public function Promote(Request $request)
    {
        $currentSeason = CurrentAcademicId();
        $validator = validator::make($request->all(), [            
            'student_id' => 'required',
            'new_class' => 'required',
            'new_class_arm' => 'required'
        ]);

        if($validator->fails()){
            $errors = $validator->errors();

            foreach($errors->all() as $error){

                $notifications = array(
                    'message' => $error,
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notifications);

            }
        } else {
            $students = $request->student_id;
            $new_class = $request->new_class;
            $new_class_arm = $request->new_class_arm;
            $new_academic_session = $currentSeason->currentSession;
            $students_info = StudentClass::select('student_id')
            ->where('student_classes.class_id', $new_class)
                ->where('student_classes.school_arm_id', $new_class_arm)
                    ->where('student_classes.academic_session_id', Active_Session()->id)
                        ->get();
            $students_in_class = count($students_info);
            $students_selected = count($students);
            $combined_students = $students_in_class + $students_selected;
            if($combined_students <= 50){
                foreach($students as $student_id => $Student){
                     StudentClass::where('student_id',$student_id)->where('status',1)->update([
                        'class_id' => $new_class,
                        'school_arm_id' => $new_class_arm,
                        'academic_session_id' => $new_academic_session,
                        'roll_number' => null
                    ]);
                }
                                
                $notifications = array(
                    'message' => 'Students Promotion Successfully Completed!',
                    'alert-type' => 'success'
                );
        
                return redirect()->back()->with($notifications);

            } else {
                $notifications = [
                    'message' => "More than 50 students can not stay in a class. There are currently $students_in_class in the selected class and you selected $students_selected to be promoted to the class which brings the total to $combined_students.",
                    'alert-type' => 'info'
                ];
        
                return redirect()->back()->with($notifications);
            }
        }

        
    }

    public function ReEnrol()
    {
        $data['Classes'] = SchoolClass::all();        
        $data['ClassArms'] = SchoolArms::all();
        $data['SchoolSessions'] = SchoolSessions::all();

        return view('backend.admin.StudentManagement.re_enrol_index',$data);
    }

    public function CreateReEnrol(Request $request) 
    {
        $validator = validator::make($request->all(), [            
            'current_class' => 'required',            
            'academic_session'  => 'required'            
        ]);

        if($validator->fails()){
            $errors = $validator->errors();

            foreach($errors->all() as $error){

                $notifications = array(
                    'message' => $error,
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notifications);
            }
        } else {
                $data['Classes'] = SchoolClass::all();        
                $data['ClassArms'] = SchoolArms::all();
                $data['current_arm'] = SchoolArms::find($request->current_class_arm);
                $data['current_class'] = SchoolClass::find($request->current_class);
                $data['current_session'] = SchoolSessions::find($request->academic_session);
                $data['StudentDetails'] = Students::select('students.students_id', 'students.admission_no', 'students.surname', 'students.firstname', 'students.middlename')
                    ->orderBy('students.surname', 'ASC')
                        ->where('class', $request->current_class)                            
                            ->where('session_admitted', $request->academic_session)
                                ->get();  
            $notifications = array(
                'message' => 'No Student was found in the selected class.',
                'alert-type' => 'info'
            );
            return count($data['StudentDetails']) ? view('backend.admin.StudentManagement.re_enrol', $data) : redirect()->back()->with($notifications);
        }
    }

    public function UpdateReEnrol(Request $request)
    {
        $currentSeason = CurrentAcademicId();
        $validator = validator::make($request->all(), [            
            'student_id' => 'required',
            'new_class' => 'required',
            'new_class_arm' => 'required'
        ]);

        if($validator->fails()){
            $errors = $validator->errors();

            foreach($errors->all() as $error){

                $notifications = array(
                    'message' => $error,
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notifications);

            }
        } else {
            $students = $request->student_id;
            $new_class = $request->new_class;
            $new_class_arm = $request->new_class_arm;
            $students_info = StudentClass::select('student_id')
            ->where('student_classes.class_id', $new_class)
                ->where('student_classes.school_arm_id', $new_class_arm)
                    ->where('student_classes.academic_session_id', Active_Session()->id)
                        ->get();
            $students_in_class = count($students_info);
            $students_selected = count($students);
            $combined_students = $students_in_class + $students_selected;           
            
            if($combined_students <= 50){                
                    try{
                        foreach($students as $student_id => $Student){
                            Students::where('students_id',$student_id)->update([
                                'class' => $new_class,
                                'classarm_id' => $new_class_arm,
                                'session_admitted' => Active_Session()->id,
                                'term_admitted' => Active_Term()->term_id
                            ]);

                            DB::table('student_classes')->updateOrInsert(
                                ['student_id' => $student_id, 'status' => 1], 
                                ['class_id' => $new_class, 'school_arm_id' => $new_class_arm, 'academic_session_id' => Active_Session()->id, 'roll_number' => null]
                            );                            
                        }

                        $notifications = array(
                            'message' => 'Student(s) Successfully Re-Enroled!',
                            'alert-type' => 'success'
                        );
                        return redirect()->back()->with($notifications);

                    } catch(\Exception $e) {
                         $notifications = [
                            'message' => $e,
                            'alert-type' => 'error'
                        ];
                        
                        return redirect()->back()->with($notifications);
                    } 

            } else {
                $notifications = [
                    'message' => "More than 50 students can not be admitted in a class. There are currently $students_in_class in the selected class and you selected $students_selected to be added in the class which brings the total to $combined_students.",
                    'alert-type' => 'info'
                ];
        
                return redirect()->back()->with($notifications);
            }
        }

    }
}


<?php

namespace App\Http\Controllers;
use App\Models\SchoolClass;
use App\Models\SchoolArms;
use App\Models\Students;
use App\Models\SchoolSessions;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class StudentPromteController extends Controller
{
    //
    
    public function Index(){        
        $data['Classes'] = SchoolClass::all();        
        $data['ClassArms'] = SchoolArms::all();
        $data['SchoolSessions'] = SchoolSessions::all();

        return view('backend.admin.StudentManagement.student_promotion',$data);
    }

    public function ViewCurrentStudents(Request $request){
        $validator = validator::make($request->all(), [            
            'current_class' => 'required',
            'acad_session'  => 'required'            
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
           if($request->class_arm){
                $data['Classes'] = SchoolClass::all();        
                $data['ClassArms'] = SchoolArms::all();
                $data['current_class'] = SchoolClass::find($request->current_class);
                $data['current_session'] = SchoolSessions::find($request->acad_session);
                $data['StudentDetails'] = Students::select('students.id', 'students.admission_no', 'students.surname', 'students.firstname', 'students.middlename')
                ->orderBy('students.surname', 'ASC')
                    ->where('class','=',$request->current_class)
                        ->where('classarm_id','=',$request->class_arm)->get();

           } else {
                $data['Classes'] = SchoolClass::all();        
                $data['ClassArms'] = SchoolArms::all();
                $data['current_session'] = SchoolSessions::find($request->acad_session);
                $data['current_class'] = SchoolClass::find($request->current_class);
                $data['StudentDetails'] = Students::select('students.id', 'students.admission_no', 'students.surname', 'students.firstname', 'students.middlename')
                ->orderBy('students.surname', 'ASC')
                    ->where('class','=',$request->current_class)
                        ->get();

           }

            return view('backend.admin.StudentManagement.student_promotion_view', $data);
        }
        
    }


    public function Promote(Request $request){
        $currentSeason = CurrentAcademicId();
        $validator = validator::make($request->all(), [            
            'student_id' => 'required',
            'new_class' => 'required',
            'new_classarm' => 'required'
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
            $new_class_arm = $request->new_classarm;
            $new_session = $currentSeason->currentSession;
            
                       
            if($students){
                foreach($students as $student_id => $Student){                    
                    $StudentDetails = Students::find($student_id);                    
                    $StudentDetails->class = $new_class;
                    $StudentDetails->classarm_id = $new_class_arm;
                    $StudentDetails->session_admitted = $new_session;
                    $StudentDetails->save();
                }
                                
                $notifications = array(
                    'message' => 'Students Promotion Successfully Completed!',
                    'alert-type' => 'success'
                );
        
                return redirect()->back()->with($notifications);

            } else {
                $notifications = array(
                    'message' => 'No Student Found in Class!',
                    'alert-type' => 'error'
                );
        
                return redirect()->back()->with($notifications);
            }
        }

        
    }
}

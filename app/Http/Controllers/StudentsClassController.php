<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;
use App\Models\StudentsClass;
use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\SchoolArms;
use App\Models\SchoolSessions;

class StudentsClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['Classes'] = SchoolClass::all();        
        $data['ClassArms'] = SchoolArms::all();
        $data['SchoolSessions'] = SchoolSessions::all();

        return view('backend.admin.StudentManagement.student_roll_generate',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_reg_no(Request $request)
    {
        try {
            $Student_Classes = StudentClass::join('students','students.students_id','student_id')->select('*')
                    ->where('academic_session_id', $request->academic_session)
                        ->where('class_id', $request->class_id)
                            ->where('school_arm_id', $request->class_arm_id)
                                ->where('roll_number', null)->orderBy('students.surname')
                                    ->get();
                                    
            if($Student_Classes->count()) {
                
                $checkRollNumber = StudentClass::select('roll_number')
                    ->where('class_id', $request->class_id)
                         ->where('school_arm_id', $request->class_arm_id)
                              ->where('academic_session_id', $request->academic_session)
                                  ->get()->max();
                
                if($checkRollNumber->roll_number == 50) {
                    $notifications = [
                        'message' => 'The Selected Class is Filled Up and Students\' Register Numbers has already been generated',
                        'alert-type' => 'info'
                    ];
                    return redirect()->back()->with($notifications);
                    
                } else {
                    $i = $checkRollNumber->roll_number > 0 ? $checkRollNumber->roll_number : 0;
                    
                    foreach ($Student_Classes as $student_class_id => $Students) {
                        $Students_Class = StudentClass::find($Students->id);            
                        $Students_Class->roll_number = $i + 1;
                        $Students_Class->save();
                        $i++;
                    }
            
                    $notifications = [
                        'message' => 'Students\' Register Numbers Generated Successfully!',
                        'alert-type' => 'success'
                    ];
                    return redirect()->back()->with($notifications);
                    }
                    
            } else {
                $notifications = [
                    'message' => 'There are no Students\' without register number(s) in the selected class',
                    'alert-type' => 'info'
                ];
                return redirect()->back()->with($notifications);
            }
            
        } catch(\Exception $e) {
            $notifications = [
                'message' => 'Error Generating Students\' Register Numbers.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notifications); 
        }
        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentsClass  $studentsClass
     * @return \Illuminate\Http\Response
     */
    public function show(StudentsClass $studentsClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentsClass  $studentsClass
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentsClass $studentsClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentsClass  $studentsClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentsClass $studentsClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentsClass  $studentsClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentsClass $studentsClass)
    {
        //
    }
}

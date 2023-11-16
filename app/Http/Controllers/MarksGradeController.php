<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MarksGradeRequest;
use App\Models\MarksGrade;
use Illuminate\Support\Facades\Validator;

class MarksGradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function MarksGrades(){

        $data['MarksGrade'] = MarksGrade::all();


        return view('backend.academics.marks_grades', $data);   

    }

    public function StoreMarksGrades(MarksGradeRequest $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:marks_grades',
            'min_score' => 'required|unique:marks_grades',
            'max_score' => 'required|unique:marks_grades',            
            'description' => 'required|unique:marks_grades', 
        ]);

        if($validator->fails()){  
            $errors = $validator->errors();

            foreach($errors->all() as $error){
                $notifications = array(
                    'message' => $error,
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notifications)->withInput();
            }
        }

        $MarksGrades = new MarksGrade();
        $MarksGrades->name = $request->name;
        $MarksGrades->min_score = $request->min_score;
        $MarksGrades->max_score = $request->max_score;
        $MarksGrades->description = $request->description;
        $MarksGrades->academic_id = 1;
        $MarksGrades->save();


        $notifications = array(
            'message' => 'Marks Grade Stored Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('marks_grades')->with($notifications);          

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\FeesType;
use App\Models\Students;
use App\Models\SchoolArms;
use App\Models\SchoolSessions;
use App\Models\SchoolClass;
use App\Models\FeesDiscount;


class FeesDiscountController extends Controller
{
    public function feesDiscount(){
        $data['Classes'] = SchoolClass::all();
        $data['feesDiscount'] = FeesDiscount::join('students','students.id','fees_discounts.student_id')
        ->join('school_sessions', 'school_sessions.id', 'fees_discounts.session_id')
            ->join('school_classes', 'school_classes.id', 'fees_discounts.class_id')
                ->join('school_terms', 'school_terms.id', 'fees_discounts.term_id')
                    ->select('fees_discounts.id as id', 'surname',
                        'school_terms.name as term_name', 'school_sessions.name as a_name', 'classname',
                                'firstname', 'middlename', 'discount_amount', 'total_fee_amount')->get();
        
        return view('backend.schoolFees.fees_discount', $data);
    }


    public function storeFeesDiscount(Request $request)
    {
        $validator = validator::make($request->all(), [            
            'class_id' => 'required',
            'student_id' => 'required',
            'discount_amount' => 'required',            
            'total_fee_amount' => 'required'
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
        } else {
            $current = CurrentAcademicId();
            $cu_term = $current->currentTerm;
            $cu_session = $current->currentSession;

            $FeesDiscount = new FeesDiscount();
            $FeesDiscount->session_id = $cu_session;
            $FeesDiscount->term_id = $cu_term;
            $FeesDiscount->class_id = $request->class_id;
            $FeesDiscount->student_id = $request->student_id;
            $FeesDiscount->total_fee_amount = $request->total_fee_amount;
            $FeesDiscount->discount_amount = $request->discount_amount;            
            
            $FeesDiscount->save();

            $discount = $request->discount_amount;
            $s_id = $request->student_id;
            $stu_name = Students::select('id', 'surname', 'firstname', 'middlename')
                ->where('students.id', $s_id)->get();            
            $total_fee_amount = $request->total_fee_amount;

            $surname = $stu_name[0]->surname;
            $firstname = $stu_name[0]->firstname;
            $middlename = $stu_name[0]->middlename;

            $notifications = array(
                'message' => "You've Successfully discounted $discount from $total_fee_amount  for $surname, $firstname $middlename.",
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notifications);
        }

        
    }
}

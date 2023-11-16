<?php

namespace App\Http\Controllers;

use App\Models\SchoolFees;
use App\Http\Requests\StoreSchoolFeesRequest;
use App\Http\Requests\UpdateSchoolFeesRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\SchoolClass;
use App\Models\FeesType;
use App\Models\FeesGroup;
use App\MOdels\SchoolArms;
use App\Models\SchoolSessions;
use App\Models\SchoolTerm;
use App\Models\Students;
use App\Models\FeesDiscount;
use App\Models\User;



class SchoolFeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function PayFees()
    {
        $Season_id = CurrentAcademicId();
        $data['Classes'] = SchoolClass::all();        
        $data['SchoolFees'] = SchoolFees::join('students','students.id','school_fees.student_id')
        ->join('school_sessions', 'school_sessions.id', 'school_fees.session_id')
            ->join('school_classes', 'school_classes.id', 'school_fees.class_id')
                ->join('school_terms', 'school_terms.id', 'school_fees.term_id')
                    ->select('school_fees.id as id', 'surname', 'passport',
                        'school_terms.name as term', 'school_sessions.name as session', 'classname', 'students.id as student_id',
                                'firstname', 'middlename', 'fee_discount', 'total_fee_amount', 'amount_paid', 
                                    'payment_ref', 'receipt_no', 'admission_no', 'school_fees.created_at as payment_date')
                                        ->get()->all(); 

        return view('backend.schoolFees.school_fees',$data);

        
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
     * @param  \App\Http\Requests\StoreSchoolFeesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFeesPay(StoreSchoolFeesRequest $request)
    {
        {
            $validator = validator::make($request->all(), [            
                'class_id' => 'required',
                'student_id' => 'required',
                'total_fee_amount' => 'required'
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

                $current = CurrentAcademicId();
                $cu_term = $current->currentTerm;
                $cu_session = $current->currentSession;
                $s_code = 'GIC';
                $y_code = date('Y');

                $id = $request->student_id;

                $fetchdiscount = FeesDiscount::where('fees_discounts.student_id', $id)
                        ->get()->all();
                $discount = 0;
                $amount_paid = 0;

                $stu_name = Students::select('id', 'surname', 'firstname', 'middlename')
                    ->where('students.id', $id)->get()->first();
                $surname = $stu_name->surname;
                $firstname = $stu_name->firstname;
                $middlename = $stu_name->middlename;


                if($request->amount_paid){
                     $amount_paid = $request->amount_paid;
                } else {
                    $amount_paid = $request->total_fee_amount;
                };

                if($fetchdiscount){
                    $discount = $fetchdiscount[0]->discount_amount;
                }

                $SchoolFee = new SchoolFees();
                $SchoolFee->session_id = $cu_session;
                $SchoolFee->term_id = $cu_term;
                $SchoolFee->class_id = $request->class_id;
                $SchoolFee->student_id = $request->student_id;
                $SchoolFee->fees_id = $request->fees_id;
                $SchoolFee->total_fee_amount = $request->total_fee_amount;
                $SchoolFee->fee_discount = $discount;
                $SchoolFee->expected_amount = ($request->total_fee_amount - $discount);                
                $SchoolFee->amount_paid = $amount_paid;
                $SchoolFee->payment_ref = $s_code.$y_code.hexdec(uniqid());
                $SchoolFee->receipt_no = $y_code.hexdec(uniqid());
                $SchoolFee->paid_by = Auth::user()->id;
                $SchoolFee->save();
    
                $notifications = array(
                    'message' => "You've Successfully Paid $amount_paid  for $surname, $firstname $middlename.",
                    'alert-type' => 'success'
                );                
    
                return redirect()->route('show_fees_receipt',$id)->with($notifications);
            }
    
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolFees  $schoolFees
     * @return \Illuminate\Http\Response
     */
    public function showFeesReceipt(SchoolFees $schoolFees, $id)
    {
        // Receipt generation
        $SchoolFees = SchoolFees::join('students','students.id','school_fees.student_id')
        ->join('school_sessions', 'school_sessions.id', 'school_fees.session_id')
            ->join('school_classes', 'school_classes.id', 'school_fees.class_id')
                ->join('school_terms', 'school_terms.id', 'school_fees.term_id')
                    ->select('school_fees.id as id', 'surname', 'passport',
                        'school_terms.name as term', 'school_sessions.name as session', 'classname',
                                'firstname', 'middlename', 'fee_discount', 'total_fee_amount', 'amount_paid', 
                                    'payment_ref', 'receipt_no', 'admission_no', 'school_fees.created_at as payment_date')
                                    ->where('school_fees.student_id', $id)
                                        ->get()->first();  
                                        
        return view('backend.schoolFees.school_fees_receipt',compact('SchoolFees'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolFees  $schoolFees
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolFees $schoolFees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSchoolFeesRequest  $request
     * @param  \App\Models\SchoolFees  $schoolFees
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolFeesRequest $request, SchoolFees $schoolFees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolFees  $schoolFees
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolFees $schoolFees)
    {
        //
    }
}

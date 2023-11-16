<?php

namespace App\Http\Controllers;

use App\Models\AssignClassFee;
use App\Http\Requests\StoreAssignClassFeeRequest;
use App\Http\Requests\UpdateAssignClassFeeRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\SchoolClass;
use App\Models\FeesType;
use App\Models\FeesGroup;
use App\Models\SchoolArms;
use App\Models\SchoolSessions;
use App\Models\SchoolTerm;

class AssignClassFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AssignFees()
    {
        $data['ClassFees'] = AssignClassFee::join('fees_groups', 'fees_groups.id', 'assign_class_fees.fee_group_id')
            ->join('school_sessions', 'school_sessions.id', 'assign_class_fees.acad_id')
                ->join('school_classes', 'school_classes.id', 'assign_class_fees.class_id')
                    ->join('school_terms', 'school_terms.id', 'assign_class_fees.term_id')
                        ->join('fees_types', 'fees_types.id', 'assign_class_fees.fee_type_id')
                            ->select('assign_class_fees.id as id','fee_amount', 'groupName', 'fees_types.name as fee_name',
                                        'school_terms.name as term_name', 'school_sessions.name as a_name', 'classname')->get();
        $data['Classes'] = SchoolClass::all();
        $data['FeeTypes'] = FeesType::all();
        $data['feesGroup'] = FeesGroup::all();
        $data['AcadSession'] = SchoolSessions::all();
        $data['Terms'] = SchoolTerm::all();
        

        return view('backend.setup.class_fees', $data);
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
     * @param  \App\Http\Requests\StoreAssignClassFeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeClassFees(StoreAssignClassFeeRequest $request)
    {
        $validator = validator::make($request->all(), [
            'acad_id' => 'required|int',
            'term_id' => 'required|int',
            'class_id' => 'required|int',
            'fee_group_id' => 'required|int',
            'fee_type_id' => 'required|int',
            'fee_amount' => 'required|int',
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
            $classFee = new AssignClassFee();
            $classFee->acad_id = $request->acad_id;
            $classFee->term_id = $request->term_id;
            $classFee->class_id = $request->class_id;
            $classFee->fee_group_id = $request->fee_group_id;
            $classFee->fee_type_id = $request->fee_type_id;
            $classFee->fee_amount = $request->fee_amount;
            
            $classFee->save();

            $FeeName = $request->fee_group_id;
            $className = 
            $notifications = array(
                'message' => "You've Successfully Assigned Fees to Class",
                'alert-type' => 'success'
            );

            return redirect()->route('assign_class_fees')->with($notifications);
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignClassFee  $assignClassFee
     * @return \Illuminate\Http\Response
     */
    public function classFees(AssignClassFee $assignClassFee)
    {
        

        return route();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignClassFee  $assignClassFee
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignClassFee $assignClassFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssignClassFeeRequest  $request
     * @param  \App\Models\AssignClassFee  $assignClassFee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssignClassFeeRequest $request, AssignClassFee $assignClassFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignClassFee  $assignClassFee
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignClassFee $assignClassFee)
    {
        //
    }
}

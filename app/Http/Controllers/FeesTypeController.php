<?php

namespace App\Http\Controllers;

use App\Models\FeesType;
use App\Models\FeesGroup;
use App\Http\Requests\StoreFeesTypeRequest;
use App\Http\Requests\UpdateFeesTypeRequest;
use Illuminate\Support\Facades\Validator;

class FeesTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $data['FeesType'] = FeesType::orderBy('name', 'ASC')->get();

        return view('backend.setup.fees_type', $data);
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
     * @param  \App\Http\Requests\StoreFeesTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFeesTypeRequest $request)
    {
        $validator = validator::make($request->all(), [            
            'name' => 'required|string',            
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
            $fee = new FeesType();            
            $fee->name = $request->name;            
            $fee->save();

            $FeeName = $request->name;
            $notifications = array(
                'message' => "$FeeName Added Successfully",
                'alert-type' => 'success'
            );

        return redirect()->route('fees_type')->with($notifications);
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeesType  $feesType
     * @return \Illuminate\Http\Response
     */
    public function show(FeesType $feesType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeesType  $feesType
     * @return \Illuminate\Http\Response
     */
    public function edit(FeesType $feesType, $id)
    {
        $data['FeesType'] = FeesType::all();
        $data['EditFeesType'] = FeesType::find($id);
        
        
        return view('backend.setup.edit_fees_type', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFeesTypeRequest  $request
     * @param  \App\Models\FeesType  $feesType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeesTypeRequest $request,$id)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required|string'
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

        $fee = FeesType::find($id);
        $fee->name = $request->name;
        $fee->save();

        $notifications = array(
            'message' => 'Fee Type Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fees_type')->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeesType  $feesType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeesType $feesType, $id)
    {
       try {
            $fee = FeesType::find($id);
            $fee->delete();
            $notifications = array(
                'message' => 'Fee Type Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('fees_type')->with($notifications);
       }catch(\Exception $e) {
            $notifications = [
                'message' => 'System could not delete fees types',
                'alert-type' => 'error'
            ];

            return back()->with($notifications);
       }
    }
}

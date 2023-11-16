<?php

namespace App\Http\Controllers;

use App\Models\SchoolSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SchoolSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.setup.schoolsetup');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'school_name' => 'required|unique:school_setups',
            'school_code' => 'required|unique:school_setups',
            'school_email' => 'required|unique:school_setups',
            'school_mobile_no' => 'required|unique:school_setups',
            'school_address' => 'required|unique:school_setups',
            'school_motto' => 'required|unique:school_setups',
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            foreach($errors->all() as $error){
                dd($error);
                $notifications = array(
                    'message' => $error,
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notifications);
            }
        }else{
            $SchoolDetails = new SchoolSetup();
            $SchoolDetails->school_name = $request->school_name;
            $SchoolDetails->school_email = $request->school_email;
            $SchoolDetails->school_motto = $request->school_motto;
            $SchoolDetails->school_code = $request->school_code;
            $SchoolDetails->school_address = $request->school_address;
            $SchoolDetails->school_mobile_no = $request->school_mobile_no;
            $SchoolDetails->created_by = Auth::user()->id;
            $SchoolDetails->updated_by = Auth::user()->id;
            $SchoolDetails->save();

            $notifications = array(
                'message' => "School Details Submitted Successfully",
                'alert-type' => 'success'
            );                

            return redirect()->back()->with($notifications);        
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolSetup  $schoolSetup
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolSetup $schoolSetup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolSetup  $schoolSetup
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolSetup $schoolSetup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolSetup  $schoolSetup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolSetup $schoolSetup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolSetup  $schoolSetup
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolSetup $schoolSetup)
    {
        //
    }
}

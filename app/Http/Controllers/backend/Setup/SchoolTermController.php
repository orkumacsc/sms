<?php

namespace App\Http\Controllers\backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolTerm;

class SchoolTermController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    
    public function SchoolTerm(){
        $data['allData'] = SchoolTerm::all();
        return view('backend.Setup.school-terms',$data);
    }

    
    public function StoreSchoolTerm(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:school_terms',
        ]);

        $data = new SchoolTerm();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('school-terms');
    }

    public function edit($term_id){
        $Terms['Term_Information'] = SchoolTerm::find($term_id);

        return view('backend.Setup.school_term_update', $Terms);
    }
    public function Update($term_id) {
        SchoolTerm::where('id',$term_id)->update([]);
    }
    
}

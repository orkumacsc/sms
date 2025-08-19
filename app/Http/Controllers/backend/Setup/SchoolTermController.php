<?php

namespace App\Http\Controllers\backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolTerm;

class SchoolTermController extends Controller
{
    // Ensure user is authenticated & authorized
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);

    }
    
    // Store School Term
    public function storeSchoolTerm(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:school_terms',
        ]);

        $data = new SchoolTerm();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('school_terms')->with([
            'message' => 'School Term Successfully Created',
            'alert-type' => 'success'
        ]);
    }

    // Update School Term
    public function storeUpdate(Request $request) {
        // Validate the incoming request
        $validatedData = $request->validate([
            'term_id' => 'required|exists:school_terms,id',
            'name' => "required|unique:school_terms,name,{$request->term_id}",
        ]);

        SchoolTerm::where('id', $request->term_id)->update(['name' => $request->name]);
        
        // Return a JSON response
        return response()->json([
            'success' => true,
            'name' => $request->name
        ]);
    }
    
}

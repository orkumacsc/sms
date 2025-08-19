<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\CurrentAcademicSeason;
use App\Models\SchoolTerm;
use DB;
use Illuminate\Http\Request;
use App\Models\SchoolSessions;


class AcademicSessionController extends Controller
{
    public function academicSession(){        
        $data['academic_sessions'] = SchoolSessions::orderBy('active_status')->get();
        $data['school_terms'] = SchoolTerm::all();
        $data['academic_seasons'] = DB::table('current_academic_seasons')
            ->join('school_terms','school_terms.id', 'current_academic_seasons.term_id')
                ->join('school_sessions','school_sessions.id', 'current_academic_seasons.session_id')
                    ->orderBy('school_sessions.id', 'desc')
                        ->select(
                                'school_terms.name AS term_name', 
                                'school_sessions.name AS session_name',
                                'current_academic_seasons.active_status',
                                'term_start', 'term_end', 'next_term_start',
                                'current_academic_seasons.id AS academic_id'
                                )                            
                            ->get()                            
                                ->groupBy('session_name');
        
        return view('backend.setup.academic_session',$data);
    }
    
    public function storeAcademicSession(Request $request){
        $validatedData = $request->validate([            
            'academic_session' => 'required|string|max:255',
        ]);

        $data = new SchoolSessions();
        $data->name = $request->academic_session;        
        $data->save();

        return redirect()->route('academic_session');
    }

    public function storeAcademicSessionDates(Request $request) {
        $validatedData = $request->validate([
            'session_id' => 'required|int',
            'term_id' => 'required|int',
            'term_start' => 'required|date',
            'term_end' => 'required|date',
            'next_term_start' => 'required|date'
        ]);

        CurrentAcademicSeason::updateOrCreate(
            [
                'session_id' => $request->session_id,
                'term_id' => $request->term_id                
            ],
            [
                'term_start' => $request->term_start,
                'term_end' => $request->term_end,
                'next_term_start' => $request->next_term_start
            ]
        );

        $notifications = [
            'message' => 'Term Information Successfully Added',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notifications);
       
    }

    public function setCurrentTerm($academic_id) {
        // Set the current term inactive
        CurrentAcademicSeason::where('active_status',1)->update(['active_status' => 2]);

        // Set current term     
        CurrentAcademicSeason::where('id',$academic_id)->update(['active_status' => 1]);
        
        // Redirect with success message
        return redirect()->back()->with([
            'message' => 'Selected term successfully set as current term',
            'alert-type' => 'success'
        ]);
    }

    public function setCurrentSession($session_id) {
        // Set the current academic session inactive
        SchoolSessions::where('active_status',1)->update(['active_status' => 2]);
        
        // Set current academic session
        SchoolSessions::where('id',$session_id)->update(['active_status' => 1]);
       
        // Redirect with success message
        return redirect()->back()->with([
            'message' => 'Selected academic session successfully set as current academic session',
            'alert-type' => 'success'
        ]);
    }
}

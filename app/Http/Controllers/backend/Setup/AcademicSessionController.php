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
    public function AcademicSession(){        
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


    public function StoreAcademicSession(Request $request){
        $validatedData = $request->validate([            
            'academic_session' => 'required',
        ]);

        $data = new SchoolSessions();
        $data->name = $request->academic_session;        
        $data->save();

        return redirect()->route('academic_session');
    }

    public function store_term_configurations(Request $request) {
        $vaidateData = $request->validate([
            'session_id' => 'required',
            'term_id' => 'required',
            'term_start' => 'required',
            'term_end' => 'required',
            'next_term_start' => 'required'
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

        $notifications = array(
            'message' => 'Term Information Successfully Added',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notifications);
       
    }

    public function set_current_term($academic_id) {
        //Set the current Term Inactive
        CurrentAcademicSeason::where('active_status',1)->update(['active_status' => 2]);
        //Set New Current Term     
        CurrentAcademicSeason::where('id',$academic_id)->update(['active_status' => 1]);
        

        $notifications = array(
            'message' => 'Selected Term Successfully set as Current Term',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notifications);
    }

    public function set_current_session($session_id) {
        //Set the current Term Inactive
        SchoolSessions::where('active_status',1)->update(['active_status' => 2]);
        //Set New Current Term     
        SchoolSessions::where('id',$session_id)->update(['active_status' => 1]);
        

        $notifications = array(
            'message' => 'Selected Term Successfully set as Current Term',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notifications);
    }
}

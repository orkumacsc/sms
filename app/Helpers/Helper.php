<?php
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\CurrentAcademicSeason;
use App\Models\SchoolSessions;
use App\Models\FeesGroup;
use App\Models\FeesType;
use App\Models\SchoolSetup;

// Helers function for school_details

if(!function_exists('SchoolDetails')){
    function SchoolDetails(){
        return SchoolSetup::all()->first();
    }
}


if(!function_exists('CurrentAcademicId')){
    function CurrentAcademicId(){
        $currentAcadSeason = CurrentAcademicSeason::select('session_id as currentSession', 'term_id as currentTerm')
            ->where('active_status', 1)->get();
            return $currentAcadSeason[0];            
    }
}

if(!function_exists('active_term')) {
    function Active_Term() {
        return DB::table('current_academic_seasons')
            ->join('school_terms','school_terms.id', 'current_academic_seasons.term_id')
                ->select(
                    'school_terms.name AS term_name', 
                    'school_terms.id AS term_id',
                    'term_start', 'term_end', 'next_term_start'
                    )->where('active_status', 1)->get()->first();
    }
}

if(!function_exists('active_session')) {
    function Active_Session() {
        return SchoolSessions::where('active_status', 1)->get()->first();
    }
}

function FeestoWords($amount){
    $toWords = new NumberFormatter("EN", NumberFormatter::SPELLOUT);
    echo ucwords($toWords->format($amount));
}

function formatCurrency($camount){
    $toCurrency = new NumberFormatter("EN", NumberFormatter::DECIMAL);
    echo $toCurrency->format($camount);
}




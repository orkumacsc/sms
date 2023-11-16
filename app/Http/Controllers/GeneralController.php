<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocalGovts;
use App\Models\States;
use App\Models\FeesType;
use App\Models\Students;
use App\Models\AssignClassFee;
use App\Models\ClassSubjects;
use DB;

class GeneralController extends Controller
{
    
    public function SchoolFees($id){
        $amount = FeesType::find($id);
        return response()->json($amount);
    }


    public function StudentByClass($id){
        $Students = Students::select('id', 'surname', 'firstname', 'middlename')->where('students.class', $id)->get();
        
        return response()->json($Students);
    }

    public function FeesDue($id){
        $current = CurrentAcademicId();
        $cu_term = $current->currentTerm;
        $cu_session = $current->currentSession;

        $FeesDue = AssignClassFee::select('id', 'fee_type_id','fee_amount')
            ->where('assign_class_fees.class_id', $id)
                ->where('assign_class_fees.acad_id', $cu_session)
                    ->where('assign_class_fees.term_id', $cu_term)
                        ->get();
        
        return response()->json($FeesDue);
    }

    public function getSubject($id){
        $Subjects = ClassSubjects::join('school_subjects', 'school_subjects.id', 'class_subjects.subject_id')
                    ->select('subject_id', 'name')->where('class_subjects.class_id', $id)->orderBy('name')
                        ->get();
        
        return response()->json($Subjects);
    }

    public function GetLGA($id){
        $LGAs = LocalGovts::select('id', 'name')->where('local_govts.states_id', $id)->orderBy('name')
                        ->get();
        
        return response()->json($LGAs);
    }
}

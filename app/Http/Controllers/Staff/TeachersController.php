<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\EmergencyContact;
use App\Models\Staff;
use Auth;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function dashboard(){        
        $authenticated_user_id = Auth::user()->id;

        $data['staff_info'] = Staff::where('user_id', $authenticated_user_id)
                ->join('religions', 'religions.id', 'staff.religion_id')
                ->join('genders', 'genders.id', 'staff.gender_id')
                ->join('departments', 'departments.id', 'staff.department_id')
                ->get()->first()->toArray();

            $data['emergency_contact_info'] = EmergencyContact::find($data['staff_info']['emergency_contact_id'])
                ->toArray();
                
                

            return view('Teachers.dashboard',$data);
    }
}

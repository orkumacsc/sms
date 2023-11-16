<?php

namespace App\Http\Controllers\admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departments;
use App\Models\Designations;
use App\Models\MaritalStatus;
use App\Models\Roles;
use App\Models\Gender;
use App\Models\Countries;
use App\Models\States;
use App\Models\LocalGovts;
use App\Models\Religions;
use App\Models\Tribes;
use App\Models\Complexions;
use App\Models\Staff;
use App\Models\EmergencyContact;
use App\Models\Qualifications;
use App\Models\User;

class StaffController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function StaffEnrollment(){
        $data['Departments'] = Departments::all();
        $data['Designations'] = Designations::all();
        $data['MaritalStatus'] = MaritalStatus::all();
        $data['Roles'] = Roles::all();
        $data['genders'] = Gender::all();
        $data['Countries'] = Countries::all();
        $data['States'] = States::all();
        $data['lgas'] = LocalGovts::all();        
        $data['Complexions'] = Complexions::all();
        $data['Religions'] = Religions::all();
        $data['Tribes'] = Tribes::all();
        $data['Qualifications'] = Qualifications::all();

        return view('backend.Staff.staff_enrollment',$data);
    }

    public function StoreStudentAdmission(Request $request){
        $validated = $request->validate([

        ]);

        $lastID = Staff::max('id');       

        $schoolCode = 'GIC';        
        $sessionCode = '22';
        $number = $lastID + 1;


        
        try{
            $Staff_User = new User();
            $Staff_User->usertype = 3;        
            $Staff_User->name = $request->surname.', '.$request->firstname.' '.$request->middlename;
            $Staff_User->username = $schoolCode.'/'.'STAFF'.'/'.$sessionCode.'/'.$number;
            $Staff_User->email = $request->email;
            $Staff_User->password = bcrypt($request->surname);
            $Staff_User->save();



            $Emergency_Contact = new EmergencyContact();
            $Emergency_Contact->surname = $request->em_surname;
            $Emergency_Contact->firstname = $request->em_firstname;
            $Emergency_Contact->middlename = $request->em_middlename;
            $Emergency_Contact->occupation = $request->em_occupation;
            $Emergency_Contact->mobile_no = $request->em_mobile_no;
            $Emergency_Contact->email = $request->em_email;
            $Emergency_Contact->address = $request->em_address;
            $Emergency_Contact->save();


            
            $Staff = new Staff();
            $Staff->staff_no = $schoolCode.'/'.'STAFF'.'/'.$sessionCode.'/'.$number;
            $Staff->user_id = $Staff_User->id;
            $Staff->department_id = $request->department_id;
            $Staff->designations_id = $request->designations_id;
            $Staff->role_id = 3;
            $Staff->surname = $request->surname;
            $Staff->firstname = $request->firstname;
            $Staff->middlename = $request->middlename;
            $Staff->gender_id = $request->gender;
            $Staff->marital_status_id = $request->marital_status_id;
            $Staff->complexions_id = $request->complexions_id;
            $Staff->date_of_birth = $request->dob;
            $Staff->nationality_id = $request->country;
            $Staff->state_id = $request->state;
            $Staff->lga_id = $request->lga;
            $Staff->tribe_id = $request->tribe;
            $Staff->email = $request->email;            
            $Staff->mobile_no = $request->mobile_no;
            $Staff->active_status = 1;        
            $Staff->religion_id = $request->religion;            
            $Staff->current_address = $request->address;
            $Staff->permanent_address = $request->pm_address;
            $Staff->qualification_id = $request->qualification_id;
            $Staff->specialization = $request->specialization;
            $Staff->emergency_contact_id = $Emergency_Contact->id;
            $Staff->staff_passport = $request->file('staff_passport')->storeAs('passports/staff', $schoolCode.'STAFF'.$sessionCode.$number.'.'.$request->file('staff_passport')->getClientOriginalExtension());       
            $Staff->save();

            $notifications = array(
                'message' => 'Staff Enrolled Successfully!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notifications);

        } catch(\Excetion $e){
            $notifications = array(
                'message' => 'Staff Enrollment Failed!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notifications);
        }      
        

    }
    
    public function StaffView(){ 
        //$data['School_Sessions'] = SchoolSessions::all();        
        $data['Staffs'] = Staff::join('emergency_contacts', 'emergency_contacts.id', '=', 'staff.emergency_contact_id')
            ->join('departments', 'departments.id', 'staff.department_id')
            ->join('genders', 'genders.id', 'staff.gender_id')
            ->join('designations', 'designations.id', 'staff.designations_id')
            ->select('staff.id', 'staff.surname', 'staff.firstname', 'staff.middlename',
                'emergency_contacts.mobile_no As em_mobile', 'staff.staff_no',
                'departments.name As dep_name', 'designations.name As des_name',
                'genders.gendername As gender')->get();

        return view('backend.Staff.staff_list', $data);
    }


    public function StaffProfile($id){
        $Profile = Staff::join('emergency_contacts', 'emergency_contacts.id', '=', 'staff.emergency_contact_id')
        ->join('departments', 'departments.id', 'staff.department_id')->join('tribes', 'tribes.id', 'staff.tribe_id')
        ->join('genders', 'genders.id', 'staff.gender_id')->join('religions', 'religions.id', 'staff.religion_id')
        ->join('designations', 'designations.id', 'staff.designations_id')->join('marital_statuses', 'marital_statuses.id', 'staff.marital_status_id')
        ->join('countries', 'countries.id', 'staff.nationality_id')->join('states', 'states.id', 'staff.state_id')->join('local_govts', 'local_govts.id', 'staff.lga_id')
        ->join('qualifications', 'qualifications.id', 'staff.qualification_id')
        ->select('staff.id', 'staff.surname', 'staff.firstname', 'staff.middlename', 'staff.staff_no', 'staff.staff_passport',
            'staff.current_address', 'staff.permanent_address', 'staff.date_of_birth', 'qualifications.name as qualification',
            'countries.name as nationality', 'states.name as state', 'local_govts.name as lga', 'marital_statuses.name as marital_status',
            'departments.name As dep_name', 'designations.name As des_name', 'tribes.name as tribe', 'staff.specialization',
            'genders.gendername As gender', 'religions.name As religion', 'staff.date_of_employment', 'staff.mobile_no', 'staff.email',
            'emergency_contacts.surname as em_surname', 'emergency_contacts.firstname as em_firstname', 'emergency_contacts.middlename as em_middlename',
            'emergency_contacts.occupation as em_occupation', 'emergency_contacts.mobile_no as em_mobile', 'emergency_contacts.email as em_email',
            'emergency_contacts.address as em_address')->find($id);
        
        if($Profile){
            return view('backend.Staff.staff_profile', compact('Profile'));
        } else {
            return redirect()->back();
        }
        

    }
}

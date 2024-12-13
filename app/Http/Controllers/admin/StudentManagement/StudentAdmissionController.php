<?php

namespace App\Http\Controllers\admin\StudentManagement;

use App\Http\Controllers\Controller;
use App\Models\SchoolArms;
use App\Models\SchoolTerm;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\SchoolClass;
use App\Models\Countries;
use App\Models\SchoolHouses;
use App\Models\Complexions;
use App\Models\Religions;
use App\Models\Tribes;
use App\Models\States;
use App\Models\LocalGovts;
use App\Models\SchoolSessions;
use App\Models\Gender;
use App\Models\ParentGuardian;
use App\Models\User;
use App\Models\StudentClass;
use Auth;

class StudentAdmissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function StudentAdmission(){
        $data['SchoolClasses'] = SchoolClass::where('session_created','=',2)->get();
        $data['ClassArms'] = SchoolArms::all();
        $data['SchoolSessions'] = SchoolSessions::all();
        $data['Countries'] = Countries::all();
        $data['States'] = States::all();
        $data['lgas'] = LocalGovts::all();
        $data['Houses'] = SchoolHouses::all();
        $data['Complexions'] = Complexions::all();
        $data['Religions'] = Religions::all();
        $data['Tribes'] = Tribes::all();
        $data['genders'] = Gender::all();
        

        return view('backend.admin.StudentManagement.student-admission',$data);
    }


    public function StoreStudentAdmission(Request $request){
        $lastID = Students::max('id');
        $pgID = ParentGuardian::max('id');
        $currentSeason = CurrentAcademicId();
        $arm_name = SchoolArms::select('school_arms.arm_name')->where('id',$request->class_arm)->first();
        $class_name = SchoolClass::where('id','=',$request->class_admitted)->select('school_classes.classname')->first();
        $classname = "$class_name->classname";

        {   
            $year = SchoolSessions::select('school_sessions.name')->where('id',$currentSeason->currentSession)->first();
            $year_code = strpos($year->name,"_") ? explode("_",$year->name) : explode("/",$year->name);
            $year_folder = strpos($year->name,"_") ? $year->name : str_replace('/','_',$year->name);
            $sessionCode = substr($year_code[0], -2);
        }
        {
            $isSenior = (strpos($class_name,'SS') || strpos($class_name,'SSS'));
            $isSenior ? 
            ($classCode = strpos($arm_name,'A') ? 'SCI': (strpos($arm_name,'B') ? 'ART' : 'COM')) :
            $classCode = str_replace(' ', '', $classname);
        }

        $schoolCode = 'GIC';                        
        $number = $lastID + 1;

        $PassportFolder = $request->file('imgPassport')->storeAs('passports/students/'.$year_folder, $schoolCode.$classCode.$sessionCode.$number.'.'.$request->file('imgPassport')->getClientOriginalExtension());


        // Student Login Credentials
        $Student_User = new User();
        $Student_User->usertype = 4;
        $Student_User->name = $request->surname.', '.$request->firstname.' '.$request->middlename;
        $Student_User->username = $schoolCode.'/'.$classCode.'/'.$sessionCode.'/'.$number;
        $Student_User->email = strtolower($request->surname).$number.'@gospelschools.sch.ng';
        $Student_User->password = bcrypt($request->surname);
        $Student_User->save();
        $login_id = $Student_User->id;

        // Parent/Guardian's table insert
        // $Parent = new ParentGuardian();
        // $Parent->surname = $request->pg_surname;
        // $Parent->firstname = $request->pg_firstname;
        // $Parent->middlename = $request->pg_middlename;
        // $Parent->occupation = $request->pg_occupation;
        // $Parent->mobile_no = $request->pg_mobile_no;
        // $Parent->email = $request->pg_email;
        // $Parent->address = $request->pg_address;
        // $Parent->save();

        //Students Tables Insert
        $Student = new Students();
        $Student->login_id = $login_id;
        $Student->admission_no = $schoolCode.'/'.$classCode.'/'.$sessionCode.'/'.$number;
        $Student->session_admitted = $currentSeason->currentSession;
        $Student->term_admitted = $currentSeason->currentTerem;
        $Student->class = $request->class_admitted;
        $Student->classarm_id = $request->class_arm;
        $Student->surname = strtoupper($request->surname);
        $Student->firstname = strtoupper($request->firstname);
        $Student->middlename = strtoupper($request->middlename);
        $Student->gender = $request->gender;
        $Student->age = $request->age;
        $Student->date_of_birth = $request->dob;
        $Student->nationality = $request->country;
        $Student->state_of_origin = $request->state_id;
        $Student->lga_of_origin = $request->lga;
        $Student->tribe = $request->tribe;
        $Student->height = $request->height;
        $Student->weight = $request->weight;
        $Student->religion = $request->religion;
        $Student->home_town = $request->home_town;
        $Student->school_houses_id = $request->house;
        $Student->address = $request->address;
        $Student->last_school = $request->school_name;
        $Student->last_class = $request->last_class;
        $Student->class = $request->class_admitted;

        $Student->passport = $PassportFolder;        
        $Student->save();


        $StudentClasses = new StudentClass();
        $StudentClasses->student_id = Students::max('id');
        $StudentClasses->class_id = $request->class_admitted;
        $StudentClasses->school_arm_id = $request->class_arm;
        $StudentClasses->academic_session_id = $currentSeason->currentSession;
        $StudentClasses->status = 1;
        $StudentClasses->save();


        $notifications = array(
            'message' => 'Student Registration Successfully Completed!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notifications);

    }

    public function StudentAdmissionView(){
        
        $data['Classes'] = SchoolClass::all();
        $data['ClassArms'] = SchoolArms::all();
        $data['School_Sessions'] = SchoolSessions::all();        
        $data['Students'] = Students::join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
        ->join('school_classes', 'school_classes.id', '=', 'students.class')
        ->join('school_arms', 'school_arms.id','=','students.classarm_id')
            ->join('genders', 'genders.id', '=', 'students.gender')
                ->select('students.students_id', 'students.date_of_birth', 'students.surname', 'students.firstname', 'students.middlename', 'students.admission_no', 'genders.gendername', 'school_classes.classname', 'school_arms.arm_name', 'school_houses.name')
                    ->get()->all();
        

        return view('backend.admin.StudentManagement.student_list', $data);
    }

    public function admission_list(Request $request){
        $Class_id = $request->class;
        $Classarm_id = $request->classarm_id;
        $Acad_Session_id = $request->acad_session;
        $data['Classes'] = SchoolClass::all();
        $data['ClassArms'] = SchoolArms::all();
        $data['School_Sessions'] = SchoolSessions::all(); 
        $data['Students'] = Students::join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
        ->join('school_classes', 'school_classes.id', '=', 'students.class')
        ->join('school_arms', 'school_arms.id','=','students.classarm_id')
        ->join('genders', 'genders.id', '=', 'students.gender')
            ->where('class','=',$Class_id)
                ->where('classarm_id',$Classarm_id)
                    ->where('session_admitted','=',$Acad_Session_id)->get()->all();       

        return view('backend.admin.StudentManagement.view_student_by_class', $data);
    }

    public function ViewStudentByClass(Request $request) {        
        $Class_id = $request->class;
        $Classarm_id = $request->classarm_id;
        $Acad_Session_id = $request->acad_session;
        $term_id = $request->term_id;
        
        $data['Classes'] = SchoolClass::all();
        $data['ClassArms'] = SchoolArms::all();
        $data['School_Sessions'] = SchoolSessions::all(); 
        $data['School_Terms'] = SchoolTerm::all();
        $data['Countries'] = Countries::all();
        $data['States'] = States::all();
        $data['LGAs'] = LocalGovts::where('states_id',7)->get();
        $data['Houses'] = SchoolHouses::all();
        $data['Complexions'] = Complexions::all();
        $data['Religions'] = Religions::all();
        $data['Tribes'] = Tribes::all();
        $data['genders'] = Gender::all();  

        if($Class_id && $Classarm_id & $Acad_Session_id && $term_id) {            
            $data['Students'] = StudentClass::join('students','students.students_id','student_classes.student_id')
            ->join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
            ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('school_arms', 'school_arms.id','=','students.classarm_id')
            ->join('genders', 'genders.id', '=', 'students.gender')
                ->where('class','=',$Class_id)
                    ->where('classarm_id', "=",$Classarm_id)
                        ->where('session_admitted','=',$Acad_Session_id)
                            ->where('term_admitted',"=",$term_id)->get()->all();

            if($data['Students']) {
                return view('backend.admin.StudentManagement.view_student_by_class', $data);
            } else {
                $notifications = [
                    'message' => 'Students have not been admitted for the selected class this academic session',
                    'alert_type' => 'error',
                ];
                return redirect()->back()->with($notifications);
            }

        } elseif ($Acad_Session_id && $term_id && $Class_id && !$Classarm_id) {

            $data['Students'] = StudentClass::join('students','students.students_id','student_classes.student_id')
            ->join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
            ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('school_arms', 'school_arms.id','=','students.classarm_id')
            ->join('genders', 'genders.id', '=', 'students.gender')
                ->where('class','=',$Class_id)                    
                    ->where('session_admitted','=',$Acad_Session_id)
                        ->where('term_admitted',"=",$term_id)->get()->all();

            if($data['Students']) {
                return view('backend.admin.StudentManagement.view_student_by_class', $data);
            } else {
                $notifications = [
                    'message' => 'Students have not been admitted for the selected class this academic session',
                    'alert_type' => 'error',
                ];
                return redirect()->back()->with($notifications);
            }

        } elseif ($Acad_Session_id && $term_id && !$Class_id && !$Classarm_id) {
            
            $data['Students'] = StudentClass::join('students','students.students_id','student_classes.student_id')
            ->join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
            ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('school_arms', 'school_arms.id','=','students.classarm_id')
            ->join('genders', 'genders.id', '=', 'students.gender')                                  
                ->where('session_admitted','=',$Acad_Session_id)
                    ->where('term_admitted',"=",$term_id)->get()->all();

            if($data['Students']) {
                return view('backend.admin.StudentManagement.view_student_by_class', $data);
            } else {
                $notifications = [
                    'message' => 'Students have not been admitted for the selected Term',
                    'alert_type' => 'error',
                ];
                return redirect()->back()->with($notifications);
            }

        } elseif($Acad_Session_id && !$term_id && !$Class_id && !$Classarm_id) {
            $data['Students'] = StudentClass::join('students','students.students_id','student_classes.student_id')
            ->join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
            ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('school_arms', 'school_arms.id','=','students.classarm_id')
            ->join('genders', 'genders.id', '=', 'students.gender')                                  
                    ->where('session_admitted','=',$Acad_Session_id)->get()->all();

            if($data['Students']) {                
                return view('backend.admin.StudentManagement.view_student_by_class', $data);
            } else {
                $notifications = [
                    'message' => 'Students have not been admitted for the selected academic session',
                    'alert_type' => 'error',
                ];
                return redirect()->back()->with($notifications);
            }

        } elseif($Acad_Session_id && !$term_id && $Class_id && $Classarm_id) {
            $data['Students'] = StudentClass::join('students','students.students_id','student_classes.student_id')
            ->join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
            ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('school_arms', 'school_arms.id','=','students.classarm_id')
            ->join('genders', 'genders.id', '=', 'students.gender')                                  
                ->where('session_admitted','=',$Acad_Session_id)
                    ->where('class','=',$Class_id)
                        ->where('classarm_id', "=",$Classarm_id)->get()->all();

            if($data['Students']) {                
                return view('backend.admin.StudentManagement.view_student_by_class', $data);
            } else {
                $notifications = [
                    'message' => 'Students have not been admitted for the selected academic session',
                    'alert_type' => 'error',
                ];
                return redirect()->back()->with($notifications);
            }

        }  elseif($Acad_Session_id && !$term_id && $Class_id && !$Classarm_id) {
            $data['Students'] = StudentClass::join('students','students.students_id','student_classes.student_id')
            ->join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
            ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('school_arms', 'school_arms.id','=','students.classarm_id')
            ->join('genders', 'genders.id', '=', 'students.gender')                                  
                ->where('session_admitted','=',$Acad_Session_id)
                    ->where('class','=',$Class_id)->get()->all();

            if($data['Students']) {                
                return view('backend.admin.StudentManagement.view_student_by_class', $data);
            } else {
                $notifications = [
                    'message' => 'Students have not been admitted for the selected academic session',
                    'alert_type' => 'error',
                ];
                return redirect()->back()->with($notifications);
            }
        } else {
            $notifications = [
                'message' => 'Select the correct combination criteria.',
                'alert_type' => 'error',
            ];
            return redirect()->back()->with($notifications);
        }
        
            
    
    }

    public function PrintAdmissionLetter($id){
        $Print = Students::join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
        ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('genders', 'genders.id', '=', 'students.gender')
                ->select('students.students_id', 'students.surname', 'students.firstname', 'students.middlename', 'students.admission_no', 
                            'genders.gendername', 'school_classes.classname', 'school_houses.name', 'students.date_of_birth', 'students.passport')
                    ->find($id);
        

        return view('backend.admin.StudentManagement.admission_letter', compact('Print'));

    }


    public function ViewStudentProfile($id){
        $Profile = Students::join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
        ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('genders', 'genders.id', '=', 'students.gender')->join('school_sessions', 'school_sessions.id', '=','students.session_admitted')
            ->join('religions', 'religions.id', '=', 'students.religion')->join('tribes', 'tribes.id', '=', 'students.tribe')
            ->join('countries', 'countries.id', '=', 'students.nationality')->join('states', 'states.id', '=', 'students.state_of_origin')
            ->join('local_govts', 'local_govts.id', '=', 'students.lga_of_origin')
                ->select('students.students_id', 'students.surname', 'students.firstname', 'students.middlename', 'students.admission_no', 
                            'genders.gendername', 'school_classes.classname', 'school_houses.name', 'students.date_of_birth', 'students.passport','school_sessions.name as session_admitted',
                            'religions.name as religion', 'tribes.name as tribe', 'countries.name as nationality', 'states.name as state', 'local_govts.name as lga',
                            'students.home_town', 'students.last_class', 'students.last_school', 'students.school_clubs',
                            'students.height', 'students.weight')
                    ->find($id);
        

        return view('backend.admin.StudentManagement.view_student_profile', compact('Profile'));

    }
    public function EditStudentRecord($id){
        $editStudent['SchoolClasses'] = SchoolClass::all();
        $editStudent['SchoolArms'] = SchoolArms::all();
        $editStudent['SchoolSessions'] = SchoolSessions::all();
        $editStudent['Countries'] = Countries::all();
        $editStudent['States'] = States::all();
        $editStudent['lgas'] = LocalGovts::all();
        $editStudent['Houses'] = SchoolHouses::all();
        $editStudent['Complexions'] = Complexions::all();
        $editStudent['Religions'] = Religions::all();
        $editStudent['Tribes'] = Tribes::all();
        $editStudent['genders'] = Gender::all();
        $editStudent['Students'] = Students::find($id);

        return view('backend.admin.StudentManagement.update_student_records', $editStudent);
    }

    public function UpdateStudentRecord(Request $request, $id){       
        
        //Students Tables Insert
        $Student = Students::find($id);
        $Student->surname = $request->surname;
        $Student->firstname = $request->firstname;
        $Student->middlename = $request->middlename;
        $Student->gender = $request->gender;
        $Student->age = $request->age;
        $Student->date_of_birth = $request->dob;
        $Student->nationality = $request->country;
        $Student->state_of_origin = $request->state;
        $Student->lga_of_origin = $request->lga;
        $Student->tribe = $request->tribe;
        $Student->height = $request->height;
        $Student->weight = $request->weight;
        $Student->religion = $request->religion;
        $Student->home_town = $request->home_town;
        $Student->school_houses_id = $request->house;
        $Student->address = $request->address;
        $Student->last_school = $request->school_name;
        $Student->last_class = $request->last_class;        
        $Student->save();

        $notifications = array(
            'message' => 'Student Record Updated Successfully Completed!',
            'alert-type' => 'success'
        );

        return redirect()->route('student_view')->with($notifications);

    }

    public function DeleteStudentRecord($id){
        $Student = Students::find($id);
        $Passport = $Student->passport;
        unlink('storage/'.$Passport);        
        $Student->delete();

        $notifications = array(
            'message' => 'Student Record Deleted Successfully Completed!',
            'alert-type' => 'success'
        );

        return redirect()->route('student_view')->with($notifications);

    }

    public function StudentTransfer(){
        $data['Classes'] = SchoolClass::all();
        $data['Students'] = Students::select('students.students_id', 'students.surname', 'students.firstname', 'students.middlename')->orderBy('students.surname', 'ASC')->get();

        return view('backend.admin.StudentManagement.student_transfer_form',$data);
    }

    public function TransferStudent(Request $request){
        
        $schoolCode = 'GIC';
        $classCode = trim($request->class);
        $sessionCode = '22';        
        $number = $request->id;
    

        $Student = Students::find($request->id);
        $Student->admission_no = $schoolCode.'/'.$classCode.'/'.$sessionCode.'/'.$number;
        $Student->class = $request->class;
        $Student->save();

        $notifications = array(
            'message' => 'Student Transfer Successfully Completed!',
            'alert-type' => 'success'
        );

        return redirect()->route('student_view')->with($notifications);

    }


    public function StudentHousesView(Request $request){
        $house_id = $request->id;
        $data['Classes'] = SchoolClass::all();
        $data['Houses'] = SchoolHouses::all();
        $data['School_Sessions'] = SchoolSessions::all(); 
        $data['Students'] = Students::join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.class', 'ASC')
        ->join('school_classes', 'school_classes.id', '=', 'students.class')
        ->join('genders', 'genders.id', '=', 'students.gender')
            ->where('school_houses_id','=',$house_id)->get()->all();

        return view('backend.admin.StudentManagement.students_houses', $data);
    }
}

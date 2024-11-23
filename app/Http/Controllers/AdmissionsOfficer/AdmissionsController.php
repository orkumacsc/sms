<?php

namespace App\Http\Controllers\AdmissionsOfficer;

use App\Http\Controllers\Controller;
use App\Models\Complexions;
use App\Models\Countries;
use App\Models\Gender;
use App\Models\LocalGovts;
use App\Models\ParentGuardian;
use App\Models\Religions;
use App\Models\SchoolArms;
use App\Models\SchoolClass;
use App\Models\SchoolHouses;
use App\Models\SchoolSessions;
use App\Models\SchoolTerm;
use App\Models\States;
use App\Models\StudentClass;
use App\Models\Students;
use App\Models\Tribes;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class AdmissionsController extends Controller
{
    public function admission() {
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

        return view('Admission_Officer.admission_form',$data);
    }

    public function admission_index() {
        $data['SchoolClasses'] = SchoolClass::all();
        $data['ClassArms'] = SchoolArms::all();
        $data['SchoolSessions'] = SchoolSessions::all();
        $data['School_Terms'] = SchoolTerm::all();
        $data['Countries'] = Countries::all();
        $data['States'] = States::all();
        $data['lgas'] = LocalGovts::all();
        $data['Houses'] = SchoolHouses::all();
        $data['Complexions'] = Complexions::all();
        $data['Religions'] = Religions::all();
        $data['Tribes'] = Tribes::all();
        $data['genders'] = Gender::all();        
        $data['Students'] = Students::join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
            ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('school_arms', 'school_arms.id','=','students.classarm_id')
            ->join('genders', 'genders.id', '=', 'students.gender')                                  
                ->where('session_admitted','=',Active_Session()->id)->get()->all();  

        return view('Admission_Officer.admission_list', $data);
    }

    public function store_student_enrolment(Request $request){
        $lastID = Students::max('students_id');
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
        if($request->file('imgPassport')){
            $PassportFolder = $request->file('imgPassport')->storeAs('passports/students/'.$year_folder, $schoolCode.$classCode.$sessionCode.$number.'.'.$request->file('imgPassport')->getClientOriginalExtension());
        }



        try {
            DB::beginTransaction();
            
            try {
                // Student Login Credentials
                $Student_User = new User();
                $Student_User->usertype = 4;
                $Student_User->name = $request->surname.', '.$request->firstname.' '.$request->middlename;
                $Student_User->username = $schoolCode.'/'.$classCode.'/'.$sessionCode.'/'.$number;
                $Student_User->email = strtolower($request->surname).$number.'@gospelschools.sch.ng';
                $Student_User->password = bcrypt($request->surname);
                $Student_User->save();
                $Student_User->toArray();

                try {
                    // Parent/Guardian's Information           
                    $Parent = new ParentGuardian();
                    $Parent->surname = $request->pg_surname;
                    $Parent->firstname = $request->pg_firstname;
                    $Parent->middlename = $request->pg_middlename;
                    $Parent->occupation = $request->pg_occupation;
                    $Parent->mobile_no = $request->pg_mobile_no;
                    $Parent->email = $request->pg_email;
                    $Parent->address = $request->pg_address;
                    $Parent->save();
                    $Parent->toArray();

                    try {
                        //Students' Information
                        $Student = new Students();
                        $Student->login_id = $Student_User->id;
                        $Student->parent_guardian = $Parent->id;
                        $Student->admission_no = $schoolCode.'/'.$classCode.'/'.$sessionCode.'/'.$number;
                        $Student->session_admitted = $currentSeason->currentSession;
                        $Student->term_admitted = $currentSeason->currentTerm;
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
                        // $Student->passport = $PassportFolder;        
                        $Student->save();
                        $Student->toArray();

                        try {                                
                            // Student Classes Details
                            $StudentClasses = new StudentClass();
                            $StudentClasses->student_id = $Student->students_id;
                            $StudentClasses->class_id = $request->class_admitted;
                            $StudentClasses->school_arm_id = $request->class_arm;
                            $StudentClasses->academic_session_id = $currentSeason->currentSession;
                            $StudentClasses->status = 1;
                            $StudentClasses->save();

                            $notifications = [
                                'message' => 'Student Enrollment Successfull!',
                                'alert-type' => 'success'
                            ];

                            DB::commit();
                            return redirect()->back()->with($notifications);

                        } catch (\Throwable $e) {   

                            $notifications = [
                                'message' => $e,
                                'alert-type' => 'error'
                            ];
        
                            DB::rollBack();
                            return redirect()->back()->with($notifications);
                        }                        
                       
                    } catch (\Throwable $e) {

                        $notifications = [
                            'message' => $e,
                            'alert-type' => 'error'
                        ];
    
                        DB::rollBack();
                        return redirect()->back()->with($notifications);
                    }  

                } catch (\Throwable $e) {

                    $notifications = [
                        'message' => 'Parent/Guardian Credentials Enrollment Unsuccessful!',
                        'alert-type' => 'error'
                    ];

                    DB::rollBack();
                    return redirect()->back()->with($notifications);

                }

            } catch (\Throwable $e) {

                $notifications = [
                    'message' => 'Student Login Credentials Creation Unsuccessful!',
                    'alert-type' => 'error'
                ];

                DB::rollBack();
                return redirect()->back()->with($notifications);

            }
            
        } catch (\Throwable $e) {

            $notifications = [
                'message' => 'Student Enrollment Unsuccessful!',
                'alert-type' => 'error'            
            ];

            DB::rollBack();
            return redirect()->back()->with($notifications);
        } 
       
    }

    public function admission_list(Request $request) {        
        $Class_id = $request->class;
        $Classarm_id = $request->classarm_id;
        $Acad_Session_id = $request->acad_session;
        $term_id = $request->term_id;
        
        $data['Classes'] = SchoolClass::all();
        $data['ClassArms'] = SchoolArms::all();
        $data['School_Sessions'] = SchoolSessions::all(); 
        $data['School_Terms'] = SchoolTerm::all();

        if($Class_id && $Classarm_id & $Acad_Session_id && $term_id) {            
            $data['Students'] = Students::join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
            ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('school_arms', 'school_arms.id','=','students.classarm_id')
            ->join('genders', 'genders.id', '=', 'students.gender')
                ->where('class','=',$Class_id)
                    ->where('classarm_id', "=",$Classarm_id)
                        ->where('session_admitted','=',$Acad_Session_id)
                            ->where('term_admitted',"=",$term_id)->get()->all();

            if($data['Students']) {
                return view('Admission_Officer.admission_list', $data);
            } else {
                $notifications = [
                    'message' => 'Students have not been admitted for the selected class this academic session',
                    'alert_type' => 'error',
                ];
                return redirect()->back()->with($notifications);
            }

        } elseif ($Acad_Session_id && $term_id && $Class_id && !$Classarm_id) {

            $data['Students'] = Students::join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
            ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('school_arms', 'school_arms.id','=','students.classarm_id')
            ->join('genders', 'genders.id', '=', 'students.gender')
                ->where('class','=',$Class_id)                    
                    ->where('session_admitted','=',$Acad_Session_id)
                        ->where('term_admitted',"=",$term_id)->get()->all();

            if($data['Students']) {
                return view('Admission_Officer.admission_list', $data);
            } else {
                $notifications = [
                    'message' => 'Students have not been admitted for the selected class this academic session',
                    'alert_type' => 'error',
                ];
                return redirect()->back()->with($notifications);
            }

        } elseif ($Acad_Session_id && $term_id && !$Class_id && !$Classarm_id) {
            
            $data['Students'] = Students::join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
            ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('school_arms', 'school_arms.id','=','students.classarm_id')
            ->join('genders', 'genders.id', '=', 'students.gender')                                  
                ->where('session_admitted','=',$Acad_Session_id)
                    ->where('term_admitted',"=",$term_id)->get()->all();

            if($data['Students']) {
                return view('Admission_Officer.admission_list', $data);
            } else {
                $notifications = [
                    'message' => 'Students have not been admitted for the selected Term',
                    'alert_type' => 'error',
                ];
                return redirect()->back()->with($notifications);
            }

        } elseif($Acad_Session_id && !$term_id && !$Class_id && !$Classarm_id) {
            $data['Students'] = Students::join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
            ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('school_arms', 'school_arms.id','=','students.classarm_id')
            ->join('genders', 'genders.id', '=', 'students.gender')                                  
                    ->where('session_admitted','=',$Acad_Session_id)->get()->all();

            if($data['Students']) {                
                return view('Admission_Officer.admission_list', $data);
            } else {
                $notifications = [
                    'message' => 'Students have not been admitted for the selected academic session',
                    'alert_type' => 'error',
                ];
                return redirect()->back()->with($notifications);
            }

        } elseif($Acad_Session_id && !$term_id && $Class_id && $Classarm_id) {
            $data['Students'] = Students::join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
            ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('school_arms', 'school_arms.id','=','students.classarm_id')
            ->join('genders', 'genders.id', '=', 'students.gender')                                  
                ->where('session_admitted','=',$Acad_Session_id)
                    ->where('class','=',$Class_id)
                        ->where('classarm_id', "=",$Classarm_id)->get()->all();

            if($data['Students']) {                
                return view('Admission_Officer.admission_list', $data);
            } else {
                $notifications = [
                    'message' => 'Students have not been admitted for the selected academic session',
                    'alert_type' => 'error',
                ];
                return redirect()->back()->with($notifications);
            }

        }  elseif($Acad_Session_id && !$term_id && $Class_id && !$Classarm_id) {
            $data['Students'] = Students::join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
            ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('school_arms', 'school_arms.id','=','students.classarm_id')
            ->join('genders', 'genders.id', '=', 'students.gender')                                  
                ->where('session_admitted','=',$Acad_Session_id)
                    ->where('class','=',$Class_id)->get()->all();

            if($data['Students']) {                
                return view('Admission_Officer.admission_list', $data);
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

    public function admission_letter($student_id){
        $student_info = Students::join('school_houses', 'school_houses.id', '=', 'students.school_houses_id')->orderBy('students.surname', 'ASC')
        ->join('school_classes', 'school_classes.id', '=', 'students.class')
            ->join('genders', 'genders.id', '=', 'students.gender')
                ->select('students.students_id', 'students.surname', 'students.firstname', 'students.middlename', 'students.admission_no', 
                            'genders.gendername', 'school_classes.classname', 'school_houses.name', 'students.date_of_birth', 'students.passport')
                    ->find($student_id);
        

        return view('Admission_Officer.admission_letter', compact('student_info'));

    }
}

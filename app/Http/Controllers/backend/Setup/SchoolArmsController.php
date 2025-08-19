<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\ClassDiscipline;
use App\Models\ClassesArms;
use App\Models\Departments;
use App\Models\SchoolSessions;
use Illuminate\Http\Request;
use App\Models\SchoolArms;
use App\Models\SchoolClass;
use App\Models\DisciplineArm;

class SchoolArmsController extends Controller
{
    public function __construct()
    {
        // Apply middleware for authentication and admin role
        $this->middleware('admin');

    }

    /**
     * Display the school arms and classes.
     *
     * @return \Illuminate\View\View
     */
    public function schoolArm()
    {
        $data['schoolArms'] = SchoolArms::get();
        $data['schoolClasses'] = SchoolClass::get();
        $data['disciplines'] = Departments::get();
        $data['academicSessions'] = SchoolSessions::get();        
        $data['classDisciplines'] = SchoolClass::whereHas('disciplines')->with(['disciplines'])->get();
        $data['disciplineArms'] = Departments::whereHas('arms')->with(['arms'])->get();
        
        return view('backend.setup.school_arms', $data);
    }

    /**
     * Store a new class arm.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeDisciplineArm(Request $request)
    {     
        // Validate the request
        $this->validate($request, $this->disciplineArmValidationRules());

        // Create or update the discipline arm
        foreach ($request->arm_id as $armId) {
            DisciplineArm::updateOrCreate(
            [
                'school_arms_id' => $armId,
                'departments_id' => $request->departments_id,
                'max_capacity' => $request->max_capacity
            ],
            [
                'active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
            );
        }

        // Flash a success message
        return redirect()->back()->with([
            'message' => 'Arm Successfully Assigned to Class',
            'alert-type' => 'success'
        ]);

    }

    /**
     * Store a new class discipline.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeClassDiscipline(Request $request)
    {
        // Validate the request
        $this->validate($request, $this->classDisciplineValidationRules());

        // Create the class discipline or get existing one if name already exists
        foreach ($request->discipline_id as $disciplineId) {
            ClassDiscipline::firstOrCreate([
            'school_classes_id' => $request->class_id,
            'departments_id' => $disciplineId,
            ]);
        }        

        // Flash a success message
        return redirect()->back()->with([
            'message' => 'Class discipline successfully created.',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Store a new school arm.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSchoolArm(Request $request)
    {
        // Validate the request
        $this->validate($request, $this->schoolArmValidationRules());

        // Create the school arm or get existing one if name already exists
        SchoolArms::firstOrCreate([
            'name' => strtoupper($request->name),
        ]);

        // Flash a success message
        return redirect()->back()->with([
            'message' => 'School arm successfully created.',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Get the validation rules for storing a school arm.
     *
     * @return array
     */
    protected function schoolArmValidationRules()
    {
        return [
            'arm_name' => 'required|string|max:255',
        ];
    }

    /**
     * Get the validation rules for storing a class arm.
     *
     * @return array
     */
    protected function disciplineArmValidationRules()
    {
        return [
            'arm_id' => 'required|array',
            'arm_id.*' => 'required|exists:school_arms,id',
            'departments_id' => 'required|exists:departments,id',
            'max_capacity' => 'integer|min:1',
        ];
    }

    /**
     * Get the validation rules for storing a class discipline.
     *
     * @return array
     */
    protected function classDisciplineValidationRules()
    {
        return [
            'class_id' => 'required|exists:school_classes,id',
            'discipline_id' => 'required|array',
            'discipline_id.*' => 'required|exists:departments,id',
        ];
    }

}
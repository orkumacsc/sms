<?php

namespace App\Http\Controllers\backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\ClassesArms;
use App\Models\ClassSubjects;
use App\Models\SchoolClassInfo;
use Illuminate\Http\Request;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Auth;

class SchoolClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');

    }

    /**
     * Store a new school class.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSchoolClass(Request $request)
    {

        $request->validate([
            'class' => 'required|string|max:255',
            'academic_session' => 'required|integer|exists:school_sessions,id',
        ]);

        $schoolClass = new SchoolClass();
        $schoolClass->classname = $request->class;
        $schoolClass->session_created = $request->academic_session;
        $schoolClass->save();

        return redirect()->back()->with([
            'message' => 'New class created successfully.',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Show the profile for a specific class.
     *
     * @param int $class_id
     * @return \Illuminate\View\View
     */
    public function classProfile($class_id)
    {
        $data['ClassArms'] = ClassesArms::join('school_classes', 'school_classes.id', 'classes_arms.school_classes_id')
            ->join('school_arms', 'school_arms.id', 'classes_arms.school_arms_id')
            ->where('school_classes_id', $class_id)->get();

        $data['ClassSubjects'] = ClassSubjects::where('class_id', $class_id)->get();
        $data['class_id'] = $class_id;

        return view('backend.setup.class_profile', $data);
    }

    /**
     * Store information about a specific class.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeClassInfo(Request $request)
    {
        $request->validate([
            'total_subjects_offered' => 'required',
            'academic_session_id' => 'required',
            'class_id' => 'required'
        ]);

        $SchoolClassInfo = new SchoolClassInfo();
        $SchoolClassInfo->class_id = $request->class_id;
        $SchoolClassInfo->total_subjects_offered = $request->total_subjects_offered;
        $SchoolClassInfo->academic_session_id = $request->academic_session_id;
        $SchoolClassInfo->created_by = Auth::user()->id;
        $SchoolClassInfo->save();

        return redirect()->back()->with([
            'message' => 'Total number of subjects offered by class successfully updated.',
            'alert-type' => 'success'
        ]);
    }
}
;

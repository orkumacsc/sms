<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\SchoolArms;
use App\Models\SchoolClass;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\Departments;
use App\Models\Staff;
use App\Models\SchoolSubjects;

class ApiController extends Controller
{
    public function getDisciplinesByClassId($id)
    {
        $class = SchoolClass::find($id);
        if (!$class) {
            return response()->json(['error' => 'Class not found'], 404);
        }
        return response()->json($class->disciplines()->get());
    }

    /**
     * Get Disciplines or Arms 
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDisciplinesOrArmsByClassId($id)
    {
       $class = SchoolClass::find($id);
       if (!$class) {
           return response()->json(['error' => 'Class not found'], 404);
       }

       if($class->category == 'JUNIOR') {
           return response()->json(['schoolArms' => SchoolArms::where('parent_id', null)->get()]);
       }
       return response()->json(['disciplines' => $class->disciplines()->get()]);       
    }

    /**
     * Get arms by discipline ID.
     */
    public function getArmsByDisciplineId($id)
    {
        $discipline = Departments::find($id);
        if (!$discipline) {
            return response()->json(['error' => 'Discipline not found'], 404);
        }
        return response()->json($discipline->arms()->get());
    }

    /**
     * Get subjects by staff ID.
     */
    public function getSubjectsByStaffId($id)
    {
        $staff = Staff::find($id);
        if (!$staff) {
            return response()->json(['error' => 'Staff not found'], 404);
        }
        return response()->json($staff->subjects()->get());
    }

}

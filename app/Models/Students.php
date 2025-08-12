<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'students_id';

    public function SchoolClasses()
    {
        return $this->belongsToMany(SchoolClass::class, 'student_classes', 'student_id', 'class_id')
            ->withPivot('academic_session_id', 'school_arm_id')
            ->withTimestamps();
    }

    public function house()
    {
        return $this->belongsTo(SchoolHouses::class, 'school_houses_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTeachers extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_classes_id',
        'school_arms_id',
        'academic_sessions_id',
        'departments_id',
        'teacher_id',
        'active_status'
    ];

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'school_classes_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Staff::class, 'teacher_id');
    }

    public function arm()
    {
        return $this->belongsTo(SchoolArms::class, 'school_arms_id');
    }

    public function academicSession()
    {
        return $this->belongsTo(SchoolSessions::class, 'academic_sessions_id');
    }

    public function department()
    {
        return $this->belongsTo(Departments::class, 'departments_id');
    }
}

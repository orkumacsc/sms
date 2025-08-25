<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_classes_id',
        'school_subjects_id',
        'departments_id',
        'school_arms_id',
        'academic_sessions_id',
        'teacher_id',
    ];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'school_classes_id');
    }

    public function subject()
    {
        return $this->belongsTo(SchoolSubjects::class, 'school_subjects_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Staff::class, 'teacher_id');
    }

    public function department()
    {
        return $this->belongsTo(Departments::class, 'departments_id');
    }

    public function arm()
    {
        return $this->belongsTo(SchoolArms::class, 'school_arms_id');
    }

    public function academicSession()
    {
        return $this->belongsTo(SchoolSessions::class, 'academic_sessions_id');
    }
}

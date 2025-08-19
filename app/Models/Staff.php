<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'surname',
        'firstname',
        'middlename',
        'gender_id',
        'date_of_birth',
        'marital_status_id',
        'religion_id',
        'department_id',
        'qualification_id',
        'complexion_id',
        'tribe_id',
        'user_id',
        'current_address',
        'permanent_address',
        'mobile_no',
        'email',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
    
    public function classGroup()
    {
        return $this->belongsToMany(SchoolClass::class, 'class_teachers', 'teacher_id', 'school_classes_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(SchoolSubjects::class, 'teacher_subjects', 'teacher_id', 'subject_id');
    }

    public function classSubjectTeachers()
    {
        return $this->hasMany(ClassSubjectTeacher::class, 'teacher_id');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'name',
        'department_id',
        'academic_session_id'
    ];

    /**
     * Summary of SchoolSubjects
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function SchoolSubjects()
    {
        return $this->belongsToMany(SchoolSubjects::class, 'class_subjects','class_id','subject_id');
    }
    
    /**
     * Summary of students
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students()
    {
        return $this->belongsToMany(Students::class, 'student_classes', 'class_id', 'student_id');
    }

    /**
     * Summary of assessmentTypes
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assessmentTypes()
    {
        return $this->belongsToMany(Assessment_Types::class, 'school_assessments', 'class_id', 'ass_type_id');
    }
}
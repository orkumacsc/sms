<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'classname',
    ];

    /**
     * Define the relationship with SchoolSubjects
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function schoolSubjects()
    {
        return $this->belongsToMany(SchoolSubjects::class, 'class_subjects','class_id','subject_id');
    }
    
    /**
     * Define the relationship with students.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students()
    {
        return $this->belongsToMany(Students::class, 'student_classes', 'class_id', 'student_id');
    }

    /**
     * Define the relationship with assessment types.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assessmentTypes()
    {
        return $this->belongsToMany(Assessment_Types::class, 'school_assessments', 'class_id', 'ass_type_id');
    }

    /**
     * Define the relationship with teachers.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teachers()
    {
        return $this->belongsToMany(Staff::class, 'class_teachers', 'class_arm_id', 'teacher_id');
    }

    /**
     * Define the relationship with school arms.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function arms()
    {
        return $this->belongsToMany(SchoolArms::class, 'classes_arms', 'school_classes_id', 'school_arms_id')
            ->withPivot('active_status');
    }

    /**
     * Define the relationship with class disciplines.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function disciplines()
    {
        return $this->belongsToMany(Departments::class, 'class_disciplines', 'school_classes_id', 'departments_id');
    }
}
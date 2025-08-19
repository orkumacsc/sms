<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSubjects extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'name',
        'code',
        'department_id',
        'academic_session_id'
    ];

    // For example, if you want to define a relationship with ClassSubjects:
    public function SchoolClasses()
    {
        return $this->belongsToMany(SchoolClass::class, 'class_subjects', 'subject_id', 'class_id')
            ->withPivot('department_id', 'session_id');
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'teacher_subjects', 'subject_id', 'teacher_id')
            ->withPivot('department_id', 'session_id');
    }

    /**
     * Summary of classDisciplines
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function classDisciplines()
    {
        return $this->belongsToMany(ClassDiscipline::class, 'discipline_subjects', 'school_subjects_id', 'class_disciplines_id')
            ->withPivot('is_compulsory')
            ->withPivot('school_sessions_id')
            ->withTimestamps();
    }

    public function academicSession()
    {
        return $this->belongsToMany(SchoolSessions::class, 'discipline_subjects', 'school_subjects_id', 'school_sessions_id')
            ->withPivot('is_compulsory')
            ->withTimestamps();
    }

}

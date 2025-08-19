<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SchoolSubjects;

class ClassDiscipline extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_classes_id',
        'departments_id',
    ];

    /**
     * Get the school class associated with the class discipline.
     */
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'school_classes_id');
    }

    /**
     * Get the department associated with the class discipline.
     */
    public function department()
    {
        return $this->belongsTo(Departments::class, 'departments_id');
    }

    /**
     * Get the subjects associated with the class discipline.
     */
    public function subjects()
    {
        return $this->belongsToMany(SchoolSubjects::class, 'discipline_subjects', 'class_disciplines_id', 'school_subjects_id')
            ->withPivot('is_compulsory')
            ->withPivot('school_sessions_id')
            ->withTimestamps();
    }

    /**
     * Get the compulsory subjects associated with the class discipline.
     */
    public function compulsorySubjects($sessionId)
    {
        return $this->subjects()->wherePivot('is_compulsory', true)
            ->wherePivot('school_sessions_id', $sessionId);
    }

    /**
     * Get the optional subjects associated with the class discipline.
     */
    public function optionalSubjects($sessionId)
    {
        return $this->subjects()->wherePivot('is_compulsory', false)
            ->wherePivot('school_sessions_id', $sessionId);
    }

    /**
     * Get the global compulsory subjects.
     */
    public function globalCompulsorySubjects()
    {
        return SchoolSubjects::where('is_global_compulsory', true);
    }

    /**
     * Get all compulsory subjects.
     */
    public function allCompulsorySubjects($sessionId)
    {
        return $this->globalCompulsorySubjects()->get()->merge($this->compulsorySubjects($sessionId)->get());
    }

    /**
     * Scope a query to include subjects.
     */
    public function scopeWithSubjects($query)
    {
        return $query->with(['subjects']);
    }  
    
    /**
     * Get the discipline name as class name + department name.
     */
    public function getDisciplineNameAttribute()
    {
        return $this->schoolClass->classname . ' ' . $this->department->name;
    }

    /**
     * Get the discipline id and name as an array.
     */
    public function getDisciplineInfoAttribute()
    {
        return [
            'id' => $this->id,
            'name' => $this->discipline_name,
        ];
    }

    /**
     * Get all subjects including global compulsory subjects for the class discipline.
     */
    public function allSubjectsWithGlobal($sessionId)
    {
        $globalSubjects = $this->globalCompulsorySubjects()->get();
        $classSubjects = $this->subjects()->wherePivot('school_sessions_id', $sessionId)->get();   
        
        return $globalSubjects->merge($classSubjects)->unique('id')->values();
    }

}

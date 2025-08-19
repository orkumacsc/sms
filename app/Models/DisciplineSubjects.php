<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisciplineSubjects extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_discipline_id',
        'school_subjects_id',
        'is_compulsory',
        'academic_session_id'
    ];

    public function getDisciplineInfoAttribute()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'subjects' => $this->subjects()->get()
        ];
    }
    public function subjects()
    {
        return $this->belongsTo(SchoolSubjects::class, 'school_subjects_id');
    }

    public function academicSession()
    {
        return $this->belongsTo(SchoolSessions::class, 'academic_session_id');
    }

    public function disciplineClass()
    {
        return $this->belongsTo(ClassDiscipline::class, 'class_discipline_id');
    }
}

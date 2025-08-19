<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSessions extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active'
    ];

    public function subjects()
    {
        return $this->belongsToMany(SchoolSubjects::class, 'discipline_subjects', 'school_sessions_id', 'school_subjects_id')
            ->withPivot('is_compulsory')
            ->withTimestamps();
    }

    public function classDisciplines()
    {
        return $this->belongsToMany(ClassDiscipline::class, 'discipline_subjects', 'school_sessions_id', 'class_disciplines_id')
            ->withPivot('is_compulsory')
            ->withTimestamps();
    }

}

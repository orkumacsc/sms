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

}

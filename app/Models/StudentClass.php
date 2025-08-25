<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SchoolClass;
use App\Models\SchoolSessions;
use App\Models\Students;
use App\Models\SchoolArms;

class StudentClass extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'class_id',
        'student_id',
        'academic_session_id',
    ];

    /**
     * Define the relationship with the student.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }

    /**
     * Define the relationship with the class.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * Define the relationship with the academic session.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function academicSession()
    {
        return $this->belongsTo(SchoolSessions::class, 'academic_session_id');
    }

    /**
     * Define the relationship with the school arm.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function schoolArm()
    {
        return $this->belongsTo(SchoolArms::class, 'school_arm_id');
    }
}

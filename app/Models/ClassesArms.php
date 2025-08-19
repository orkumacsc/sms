<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassesArms extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_classes_id',
        'school_arms_id',
    ];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'school_classes_id');
    }

    public function schoolArm()
    {
        return $this->belongsTo(SchoolArms::class, 'school_arms_id');
    }
}

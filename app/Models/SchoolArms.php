<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolArms extends Model
{
    use HasFactory;

    protected $fillable = [
        'arm_name',
        'active status'
    ];

    public function classes()
    {
        return $this->belongsToMany(SchoolClass::class, 'classes_arms', 'school_arms_id', 'school_classes_id')
            ->withPivot('active_status');
    }

    public function departments()
    {
        return $this->belongsToMany(Departments::class, 'discipline_arms', 'school_arms_id', 'departments_id');
    }


}

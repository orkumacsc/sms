<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisciplineArm extends Model
{
    use HasFactory;

    protected $fillable = [
        'departments_id',
        'school_arms_id',
        'max_capacity'
    ];

    public function discipline()
    {
        return $this->belongsTo(Departments::class, 'departments_id');
    }

    public function schoolArm()
    {
        return $this->belongsTo(SchoolArms::class, 'school_arms_id');
    }
}

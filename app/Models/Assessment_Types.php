<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment_Types extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function classes()
    {
        return $this->belongsToMany(SchoolClass::class, 'school_assessments', 'ass_type_id', 'class_id');
    }
}

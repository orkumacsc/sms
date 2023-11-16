<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Students(){
        return $this->hasMany(Students::class);
    }

    public function Subjects(){
        return $this->hasMany(SchoolSubjects::class);
    }
}

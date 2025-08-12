<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Students;

class SchoolHouses extends Model
{
    use HasFactory;

    public function students()
    {
        return $this->hasMany(Students::class, 'school_houses_id');
    }
}

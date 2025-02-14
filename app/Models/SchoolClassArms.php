<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClassArms extends Model
{
    use HasFactory;

    protected $fillable = [
        'arm_id',
        'class_id',
        'active_status'
    ];
}

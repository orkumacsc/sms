<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function schoolClasses()
    {
        return $this->belongsToMany(SchoolClass::class, 'class_disciplines', 'departments_id', 'school_classes_id');
    }

    /**
     * Define the relationship with school arms.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function arms()
    {
        return $this->belongsToMany(SchoolArms::class, 'discipline_arms', 'departments_id', 'school_arms_id');
    }
}

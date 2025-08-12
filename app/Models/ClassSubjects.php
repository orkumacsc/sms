<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubjects extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'class_id',
        'subject_id',
        'department_id',
        'teacher_id',
        'academic_session_id'
    ];

    public function create($records)
    {
        try {
            foreach ($records as $record) {
                ClassSubjects::updateOrCreate([
                    'class_id' => $record['class_id'],
                    'department_id' => $record['department_id'],
                    'subject_id' => $record['subject_id']
                ]);
            }
        } catch (\Exception $e) {

            $notifications = array(
                'message' => 'Error in sumbitting records to database! Contact Support!',
                'alert-type' => 'error'
            );

            return back()->with($notifications);
        }
    }

    public function school_subjects()
    {
        return $this->belongsTo('App\SmSchoolSubject', 'subject_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarksRegisters extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'total_scores', 'student_id', 'academic_session_id', 'subject_position',
        'class_id', 'class_arm_id', 'term_id', 'subject_id'
    ];

    public function create($records) {
        try {
            foreach($records as $record){
                MarksRegisters::updateOrCreate([
                    'subject_id' => $record['subject_id'],
                    'class_id' => $record['class_id'],
                    'class_arm_id' => $record['class_arm_id'],
                    'academic_session_id' => $record['academic_session_id'],
                    'student_id' => $record['student_id'],
                    'term_id' => $record['term_id']
                ], ['total_scores' => $record['total_scores'], 'subject_position' => $record['subject_position']]);
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to update students marks. '.$e->getMessage());
        }
    }
}

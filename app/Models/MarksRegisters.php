<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarksRegisters extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function create($records) {
        try {
            foreach($records as $record){
                MarksRegisters::updateOrCreate([
                    'total_scores' => $record['total_scores'],
                    'subject_id' => $record['subject_id'],
                    'class_id' => $record['class_id'],
                    'session_id' => $record['session_id'],
                    'student_id' => $record['student_id'],
                    'term_id' => $record['term_id']
                ]);
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to update students marks. '.$e->getMessage());
        }
    }
}

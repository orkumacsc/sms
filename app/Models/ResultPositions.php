<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultPositions extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function create($records) 
    {
        try {
            foreach($records as $record){
                ResultPositions::updateOrCreate([
                    'obtained_marks' => $record['obtained_marks'],
                    'classarm_id' => $record['classarm_id'],
                    'class_id' => $record['class_id'],
                    'session_id' => $record['session_id'],
                    'student_id' => $record['student_id'],
                    'term_id' => $record['term_id'],
                    'computed_by' => $record['computed_by'],
                    'total_subjects_offered' => $record['total_subjects_offered'],
                    'obtainable_marks' => $record['obtainable_marks']
                ]);
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to update students marks. '.$e->getMessage());
        }
    }
}

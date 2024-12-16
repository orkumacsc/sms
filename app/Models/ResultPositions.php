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
            foreach ($records as $record) {
                ResultPositions::updateOrCreate([
                    'class_arm_id' => $record['class_arm_id'],
                    'class_id' => $record['class_id'],
                    'session_id' => $record['session_id'],
                    'student_id' => $record['student_id'],
                    'term_id' => $record['term_id']
                ], [
                    'obtained_marks' => $record['obtained_marks'],
                    'total_subjects_offered' => $record['total_subjects_offered'],
                    'obtainable_marks' => $record['obtainable_marks'],
                    'average_score' => $record['average_score'],
                    'position_in_class' => $record['position_in_class']
                ]);
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to update students marks. ' . $e->getMessage());
        }
    }
}

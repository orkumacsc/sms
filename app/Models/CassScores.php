<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CassScores extends Model
{
    use HasFactory;
    protected $fillable = [
        'cass_type', 'student_id', 'session_id',
        'class_id', 'term_id', 'subject_id', 'scores'
    ];

    public function create($rows) {
        try {
            foreach($rows as $row){
                CassScores::updateOrCreate([
                    'cass_type' => $row['cass_type'],
                    'student_id' => $row['student_id'],
                    'session_id' => $row['session_id'],
                    'class_id' => $row['class_id'],
                    'term_id' => $row['term_id'],
                    'subject_id' => $row['subject_id']
                ],['scores' => $row['scores']]);
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to update students marks. '.$e->getMessage());
        }
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentAcademicSeason extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'term_id',
        'term_start',
        'term_end',
        'next_term_start'
    ];
}

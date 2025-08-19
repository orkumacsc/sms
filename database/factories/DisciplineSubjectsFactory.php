<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DisciplineSubjects>
 */
class DisciplineSubjectsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'class_disciplines_id' => \App\Models\ClassDiscipline::factory(),
            'school_subjects_id' => \App\Models\SchoolSubjects::factory(),
            'is_compulsory' => $this->faker->boolean,
            'school_sessions_id' => \App\Models\SchoolSessions::factory(),
        ];
    }
}

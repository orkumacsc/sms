<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassDiscipline>
 */
class ClassDisciplineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'school_classes_id' => \App\Models\SchoolClass::factory(),
            'departments_id' => \App\Models\Departments::factory(),
        ];
    }
}

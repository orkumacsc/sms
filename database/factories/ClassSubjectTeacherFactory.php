<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassSubjectTeacher>
 */
class ClassSubjectTeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'teacher_id' => StaffFactory::new()->create()->id,
            'subject_id' => SchoolSubjectsFactory::new()->create()->id,
            'class_id' => SchoolClassFactory::new()->create()->id,
        ];
    }
}

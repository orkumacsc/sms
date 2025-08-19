<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolSubjects>
 */
class SchoolSubjectsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'subject_name' => $this->faker->sentence(rand(2, 3)),            
            'is_global_compulsory' => $this->faker->boolean,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'surname' => $this->faker->lastName(),
            'firstname' => $this->faker->firstName(),
            'middlename' => $this->faker->firstName(),
            'gender_id' => $this->faker->randomElement([1, 2]),
            'date_of_birth' => $this->faker->date(),
            'marital_status_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7]),
            'religion_id' => $this->faker->randomElement([1, 2, 3]),
            'department_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'qualification_id' => $this->faker->randomElement([1, 2, 3, 4]),
            'complexion_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'tribe_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'user_id' => UserFactory::new()->create()->id,
            'current_address' => $this->faker->address(),
            'permanent_address' => $this->faker->address(),
            'mobile_no' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),            
        ];
    }
};


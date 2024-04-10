<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserSalary>
 */
class UserSalaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hourly_rate' => fake()->randomFloat(2, 10, 100),
            'user_id' => fake()->numberBetween(1, 500),
        ];
    }
}

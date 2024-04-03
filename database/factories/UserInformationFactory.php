<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserInformation>
 */
class UserInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'banner' => fake()->imageUrl(),
            'title' => fake()->sentence(),
            'phone' => fake()->phoneNumber(),
            'date_of_birth' => fake()->date(),
            'about' => fake()->paragraph(),
            'user_id' => fake()->numberBetween(1, 500),
        ];
    }
}

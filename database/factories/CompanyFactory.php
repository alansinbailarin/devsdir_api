<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'slug' => fake()->slug(),
            'description' => fake()->paragraph(),
            'logo' => fake()->imageUrl(),
            'banner' => fake()->imageUrl(),
            'url' => fake()->url(),
            'company_type_id' => fake()->numberBetween(1, 10),
        ];
    }
}

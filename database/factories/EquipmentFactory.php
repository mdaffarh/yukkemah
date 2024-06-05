<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'price_per_day' => fake()->numberBetween(20000, 200000),
            'description' => fake()->paragraph(1),
            'category_id' => rand(1, 3),
            'brand_id' => rand(1, 3),
            'stock' => rand(0, 5),
            'on_rent' => rand(0, 5)
        ];
    }
}

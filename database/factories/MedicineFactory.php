<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
        'instruction' => fake()->sentence,
        'category_id' => fake()->numberBetween(1,10),
        'purchase_price' => fake()->randomFloat(null,1,5000),
        'sale_price' => fake()->randomFloat(null,1,5000),
        'quantity' => fake()->numberBetween(1,1000),
        'company' => fake()->company,
        'expire_date' => fake()->date(),
        ];
    }
}

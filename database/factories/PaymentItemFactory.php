<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentItem>
 */
class PaymentItemFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'name' => fake()->name(),
      'code' => 'P-' . fake()->numberBetween(1, 10),
      'type' => 'Other',
      'price' => fake()->randomFloat(null, 1, 5000),
      'commission' => fake()->numberBetween(10, 100) . '%',
      'quantity' => fake()->numberBetween(100, 1000),
    ];
  }
}

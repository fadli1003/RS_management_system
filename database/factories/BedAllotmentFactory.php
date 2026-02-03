<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BedAllotment>
 */
class BedAllotmentFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'bed_id' => fake()->numberBetween(1, 10),
      'patient_id' => fake()->numberBetween(1, 10),
      'start_date' => fake()->date(),
      'end_date' => fake()->date(),
      'start_time' => fake()->time(),
      'end_time' => fake()->time(),
      'status' => 'Up Coming Allotment',
    ];
  }
}

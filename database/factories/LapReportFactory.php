<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LapReport>
 */
class LapReportFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'date' => fake()->date(),
      'time' => fake()->time(),
      'patient_id' => fake()->numberBetween(1, 10),
      'doctor_id' => fake()->numberBetween(1, 10),
      'template_id' => fake()->numberBetween(1, 10),
      'report' => fake()->text(),
    ];
  }
}

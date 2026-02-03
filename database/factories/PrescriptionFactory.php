<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescription>
 */
class PrescriptionFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'patient_id' => fake()->numberBetween(1, 10),
      'doctor_id' => fake()->numberBetween(1, 10),
      'blood_pressure' => fake()->numberBetween(80, 200) . '/' . fake()->numberBetween(80, 200),
      'diabetes' => fake()->sentence,
      'symptoms' => fake()->sentence,
      'diagnosis' => fake()->sentence,
      'advice' => fake()->sentence,
      'date' => fake()->date(),
    ];
  }
}

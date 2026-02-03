<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CaseHistory>
 */
class CaseHistoryFactory extends Factory
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
      'date' => fake()->date(),
      'title' => fake()->sentence(),
      'food_allergies' => fake()->sentence(),
      'bleed_tendency' => fake()->sentence(),
      'heart_disease' => fake()->sentence(),
      'diabetic' => fake()->sentence(),
      'surgery' => fake()->sentence(),
      'accident' => fake()->sentence(),
      'family_medical_history' => fake()->sentence(),
      'current_medication' => fake()->sentence(),
      'female_pregnancy' => fake()->sentence(),
      'breast_feeding' => fake()->sentence(),
      'health_insurance' => fake()->sentence(),
      'low_income' => fake()->sentence(),
      'reference' => fake()->sentence(),
      'others' => fake()->sentence(),
      'status' => 'active',
      'blood_pressure' => fake()->numberBetween(80, 200) . '/' . fake()->numberBetween(80, 200),
    ];
  }
}

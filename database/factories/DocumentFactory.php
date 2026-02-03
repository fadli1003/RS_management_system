<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
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
      'date' => fake()->date(),
      'description' => fake()->sentence(),
      'doc' => 'patients_documents/T34J3Irn2u0xNKbt5HSe1vYaYnbOBS84gpT9IBIt.txt',
    ];
  }
}

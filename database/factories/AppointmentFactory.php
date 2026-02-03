<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $array = ['confirmed', 'pending'];
    return [
      'patient_id' => fake()->numberBetween(1, 10),
      'doctor_id' => fake()->numberBetween(1, 10),
      'department_id' => fake()->numberBetween(1, 10),
      'date' => fake()->dateTimeBetween('-1 years', '+1 years'),
      'time' => fake()->time(),
      'status' => Arr::random($array),
      'notes' => fake()->sentence,
    ];
  }
}

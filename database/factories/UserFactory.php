<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
  /**
   * The current password being used by the factory.
   */
  protected static ?string $password;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    // return [
    //     'name' => fake()->name(),
    //     'email' => fake()->unique()->safeEmail(),
    //     'email_verified_at' => now(),
    //     'password' => static::$password ??= Hash::make('password'),
    //     'remember_token' => Str::random(10),
    // ];

    $array = ['admin', 'doctor', 'patient', 'nurse', 'accountant', 'pharmacist', 'laboratorist', 'receptionist'];
    return [
      'first_name' => fake()->name(),
      'last_name' => fake()->name,
      'national_id' => fake()->numberBetween(10000000000000, 99999999999999),
      'address' => fake()->streetAddress,
      'email' => fake()->unique()->safeEmail,
      'password' => \Illuminate\Support\Facades\Hash::make(fake()->password),
      'picture' => 'https://picsum.photos/id/' . fake()->numberBetween(1, 999) . '/200/200',
      'blood_group' => 'O+',
      'birth_date' => fake()->dateTime,
      'gender' => 'male',
      'type' => Arr::random($array),
      'phone' => fake()->numberBetween(1000000000, 9999999999),
      'mobile' => fake()->numberBetween(1000000000, 9999999999),
      'emergency' => fake()->numberBetween(1000000000, 9999999999),
    ];
  }

  /**
   * Indicate that the model's email address should be unverified.
   */
  public function unverified(): static
  {
    return $this->state(fn(array $attributes) => [
      'email_verified_at' => null,
    ]);
  }
}

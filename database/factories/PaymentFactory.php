<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => fake()->numberBetween(1,10),
        'doctor_id' => fake()->numberBetween(1,10),
        'sub_total' => fake()->numberBetween(1,1000),
        'total' => fake()->numberBetween(1000,100000),
        'amount_received' => fake()->numberBetween(1000,100000),
        'amount_to_pay' => fake()->numberBetween(1000,100000),
        'doctor_commission' => fake()->numberBetween(1000,100000),
        'taxes' => fake()->numberBetween(1,100),
        ];
    }
}

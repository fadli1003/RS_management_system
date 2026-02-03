<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimeSchedule>
 */
class TimeScheduleFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $array = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
    $array1 = [5, 10, 15, 20, 30, 45, 60];
    $array2 = [0, 1, 2, 3, 4, 5, 6];
    $v = Arr::random($array2);
    return [
      'week_day' => $array[$v],
      'week_num' => $v,
      'start_time' => date('H:i:s', rand(1, 54000)),
      'end_time' => date('H:i:s', rand(54000, 86400)),
      'duration' => Arr::random($array1),
      'user_id' => fake()->numberBetween(1, 10),
    ];
  }
}

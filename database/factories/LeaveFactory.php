<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leave>
 */
class LeaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'leave_type_id' => Leave::inRandomOrder()->first()->id,
            'employee_id' => Employee::inRandomOrder()->first()->id,
            'starts_on' => $this->faker->dateTimeBetween("+10"),
            'ends_on' => $this->faker->dateTimeBetween("+20"),
            'days' => $this->faker->numberBetween(1,10),
            'reason' => $this->faker->realText(),
            'status' => $this->faker->randomElement(['New','Approved','Declined','Pending']),
        ];
    }
}

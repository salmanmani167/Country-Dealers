<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Overtime>
 */
class OvertimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::inRandomOrder()->first()->id,
            'overtime_date' => $this->faker->dateTimeBetween('+2 days','+30 days'),
            'hours' => $this->faker->numberBetween(1,5),
            'description' => $this->faker->paragraph(),
            'type' => $this->faker->word(),
            'approved' => $this->faker->randomElement([1,0])
        ];
    }
}

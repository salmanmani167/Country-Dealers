<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Projects\Entities\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timesheet>
 */
class TimesheetFactory extends Factory
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
            'project_id' => Project::inRandomOrder()->first()->id,
            'deadline' => $this->faker->dateTimeThisYear(),
            'date_' => $this->faker->dateTimeThisMonth(),
            'hours' => $this->faker->numberBetween(0,10),
            'total_hours' => $this->faker->numberBetween(0,10),
            'remaining_hours' => $this->faker->numberBetween(0,1),
            'description' => $this->faker->realText()
        ];
    }
}

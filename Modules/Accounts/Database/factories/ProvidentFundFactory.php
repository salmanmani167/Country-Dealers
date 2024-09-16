<?php

namespace Modules\Accounts\Database\factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProvidentFundFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Accounts\Entities\ProvidentFund::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => Employee::inRandomOrder()->first()->id,
            'type' => $this->faker->randomElement(['Fixed','Percentage']),
            'employee_share_amount' => $this->faker->numberBetween(100,1000),
            'org_share_amount' => $this->faker->numberBetween(100,1000),
            'employee_share_percent' => $this->faker->numberBetween(1,100),
            'org_share_percent' => $this->faker->numberBetween(1,100),
            'description' => $this->faker->paragraph(),
        ];
    }
}


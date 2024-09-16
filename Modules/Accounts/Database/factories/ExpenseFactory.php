<?php

namespace Modules\Accounts\Database\factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Accounts\Entities\Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'user_id' => User::inRandomOrder()->first()->id,
            'purchased_from' => $this->faker->company(),
            'purchased_date' => $this->faker->dateTimeBetween(),
            'payment_method' => $this->faker->randomElement(['Cash','Cheque']),
            'amount' => $this->faker->numberBetween(100),
            'file' => null,
            'status' => $this->faker->randomElement(['Approved','Pending']),
        ];
    }
}


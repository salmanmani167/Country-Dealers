<?php

namespace Modules\Accounts\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Accounts\Entities\Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'supplier' => $this->faker->name(),
            'quantity' => $this->faker->numberBetween(10,200),
            'cost_price' => $this->faker->numberBetween(100,1000),
            'retail_price' => $this->faker->numberBetween(101,1001),
            'description' => $this->faker->realText(),
        ];
    }
}


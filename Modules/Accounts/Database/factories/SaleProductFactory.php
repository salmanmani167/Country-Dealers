<?php

namespace Modules\Accounts\Database\factories;

use Modules\Accounts\Entities\Sale;
use Modules\Accounts\Entities\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Accounts\Entities\SaleProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sale_id' => Sale::factory(),
            'product_id' => Product::inRandomOrder()->first()->id,
            'price' => $this->faker->numberBetween(100,200),
            'quantity' => $this->faker->numberBetween(100,200),
        ];
    }
}


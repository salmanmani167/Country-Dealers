<?php

namespace Modules\Apps\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Apps\Entities\Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'date_' => $this->faker->dateTimeBetween("+20"),
            'category' => $this->faker->randomElement(['Danger','Success','Purple','Primary','Pink','Info'])
        ];
    }
}


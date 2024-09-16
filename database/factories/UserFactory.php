<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'is_client' => $this->faker->randomElement([false, true]),
            'is_employee'=> $this->faker->randomElement([false, true]),
            'is_cordinator'=> $this->faker->randomElement([false, true]),
            'active'=> true,
            'password' => Hash::make('password'),
            'gender' => $this->faker->randomElement(['male','female']),
            'birthdate' => $this->faker->date(),
            'address' => $this->faker->address(),
            'country' => $this->faker->country(),
            'state' => $this->faker->city(),
            'zip_code' => $this->faker->countryCode(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

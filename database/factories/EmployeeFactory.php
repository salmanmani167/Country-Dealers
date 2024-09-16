<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\House;
use App\Models\Agency;
use App\Models\Department;
use App\Models\Designation;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create([
            'is_employee' => true,
            'is_client' => false,
        ]);

        $houseId = House::inRandomOrder()->first()->id;
        $agencyId =  Agency::inRandomOrder()->first()->id;
        $designation =  Designation::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'emp_id' => IdGenerator::generate(['table' => 'employees', 'field' => 'emp_id', 'length' => 10, 'prefix' => 'EMP-']),
            'house_id' => $houseId,
            'agency_id' => $agencyId,
            'department_id' => $designation->department_id,
            'designation_id' => $designation->id,
            'date_joined' => $this->faker->date(),
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '233542441933',
            'is_client' => false,
            'is_employee'=> false,
            'is_cordinator'=> false,
            'active'=> true,
            'password' => Hash::make('admin'),
            'gender' => 'male',
            'birthdate' => null,
            'address' => null,
            'country' => 'Ghana',
            'state' => 'Accra',
            'zip_code' => '0233',
            'avatar' => null
        ]);
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'username' => $this->faker->unique()->userName,
            'password' => bcrypt('password'), 
            'role' => $this->faker->randomElement(['Administrator', 'CSO', 'User']),
            'store_code' => $this->faker->regexify('[A-Z]{3}-[0-9]{4}'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MemberFactory extends Factory
{
    protected $model = \App\Models\Member::class;

    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName,
            'password' => bcrypt('password'), 
            'otp' => $this->faker->numerify('######'),
            'full_name' => $this->faker->name,
            'address' => $this->faker->address,
            'zipcode_id' => $this->faker->numberBetween(10000, 99999),
            'phone_1' => $this->faker->phoneNumber,
            'phone_2' => $this->faker->optional()->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'nric_type_id' => $this->faker->numberBetween(1, 5),
            'nric' => $this->faker->bothify('N########'),
            'store_code' => $this->faker->word,
            'total_points' => $this->faker->numberBetween(0, 1000),
            'total_undians' => $this->faker->numberBetween(0, 100),
            'registered_at' => $this->faker->date(),
            'first_logged_in_at' => $this->faker->date(),
            'question_1' => $this->faker->numberBetween(1, 10),
            'question_2' => $this->faker->numberBetween(1, 10),
            'answer_1' => $this->faker->sentence,
            'answer_2' => $this->faker->sentence,
            'is_blocked' => $this->faker->boolean ? '1' : '0',
            'created_by' => $this->faker->numberBetween(1, 10),
            'updated_by' => $this->faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
            'favourite_stores' => $this->faker->sentence,
            'store_site_code_sales' => $this->faker->word,
            'password_md5' => md5('password'),
            'total_tokens' => $this->faker->numberBetween(0, 1000),
            'keterangan' => $this->faker->sentence,
            'approve_cso' => $this->faker->boolean ? 1 : 0,
            'approve_admin' => $this->faker->boolean ? 1 : 0,
            'approve_cso_at' => now(),
            'approve_admin_at' => now(),
            'approve_cso_by' => $this->faker->numberBetween(1, 10),
            'approve_admin_by' => $this->faker->numberBetween(1, 10),
            'tokopedia' => $this->faker->word,
            'shopee' => $this->faker->word,
            'bukalapak' => $this->faker->word,
            'lain_lain' => $this->faker->word,
            'remember_token' => Str::random(10),
            'photo' => $this->faker->imageUrl(),
            'type_customer' => $this->faker->randomElement(['SPG', 'UMUM']),
            'brand' => $this->faker->word,
        ];
    }
}

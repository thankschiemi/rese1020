<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Member;

class MemberFactory extends Factory
{
    protected $model = Member::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
            'role' => 'member',
            'remember_token' => Str::random(10),
        ];
    }
    public function admin()
    {
        return $this->state([
            'role' => 'admin',
        ]);
    }

    public function owner()
    {
        return $this->state([
            'role' => 'owner',
        ]);
    }
}

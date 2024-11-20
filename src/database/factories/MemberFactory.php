<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MemberFactory extends Factory
{
    protected $model = Member::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name, // ランダムな名前
            'email' => $this->faker->unique()->safeEmail, // ランダムなメール
            'password' => bcrypt('password'), // ハッシュ化されたパスワード
        ];
    }
}

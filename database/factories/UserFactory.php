<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'gender' => rand(0, 1), // 0: Nam, 1: Nữ
            'birthday' => fake()->date('Y-m-d', '2005-01-01'),
            'phone' => substr(fake()->phoneNumber, 0, 15),
            'address' => fake()->address,
            'img' => 'https://via.placeholder.com/150', // Ảnh placeholder
            'role' => 1, // 0: Admin, 1: User
            'status' => rand(0, 1), // 0: Inactive, 1: Active
            'email' => fake()->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Mật khẩu mặc định
            'remember_token' => fake()->sha1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

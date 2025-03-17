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
        $timing = '1:' . fake()->randomFloat(0, 0, 1) . ':' . fake()->randomFloat(0, 10, 15) . ':' . fake()->randomFloat(0, 17, 22) . ';2:' . fake()->randomFloat(0, 0, 1) . ':' . fake()->randomFloat(0, 10, 15) . ':' . fake()->randomFloat(0, 17, 22) . ';3:' . fake()->randomFloat(0, 0, 1) . ':' . fake()->randomFloat(0, 10, 15) . ':' . fake()->randomFloat(0, 17, 22) . ';4:' . fake()->randomFloat(0, 0, 1) . ':' . fake()->randomFloat(0, 10, 15) . ':' . fake()->randomFloat(0, 17, 22) . ';5:' . fake()->randomFloat(0, 0, 1) . ':' . fake()->randomFloat(0, 10, 15) . ':' . fake()->randomFloat(0, 17, 22) . ';6:' . fake()->randomFloat(0, 0, 1) . ':' . fake()->randomFloat(0, 10, 15) . ':' . fake()->randomFloat(0, 17, 22) . ';7:' . fake()->randomFloat(0, 0, 1) . ':' . fake()->randomFloat(0, 10, 15) . ':' . fake()->randomFloat(0, 17, 22) . ';';

        return [
            'name' => fake()->name(),
            'rate' => fake()->randomFloat('1', '4', '5'),
            'isStreamer' => 'true',
            'timing' => $timing,
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('1234'),
            'remember_token' => Str::random(10),
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